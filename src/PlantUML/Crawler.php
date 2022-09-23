<?php

/**
 * PlantUML
 *
 * @category PhpPlantUML\PlantUML
 * @package PhpPlantUML\PlantUML
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML;

use PhpParser\Node\Stmt;
use PhpParser\NodeDumper;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use PhpPlantUML\PlantUML\Exception\UnableToParseFile;
use PhpPlantUML\PlantUML\Factory\ClassModelFactory;
use PhpPlantUML\PlantUML\Factory\InterfaceModelFactory;
use PhpPlantUML\PlantUML\Factory\TraitModelFactory;
use PhpPlantUML\PlantUML\Model\Model;
use SplFileInfo;
use SplFileObject;

final class Crawler
{
    protected Parser $parser;

    /**
     * @var array<\PhpParser\Node\Stmt>
     */
    protected array $ast = [];

    protected Model $model;

    public function __construct(protected SplFileInfo $file)
    {
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    }

    public function getModel(): Model
    {
        if (count($this->ast) === 0) {
            $this->parse();
        }

        return $this->model;
    }

    public function getAst(): string
    {
        if (count($this->ast) === 0) {
            $this->parse();
        }

        return (new NodeDumper)->dump($this->ast);
    }

    protected function parse(): self
    {
        $fileObj = $this->file->openFile('r');
        assert($fileObj instanceof SplFileObject);
        $code = $fileObj->fread($fileObj->getSize());
        assert($code !== false);
        $arr = $this->parser->parse($code);

        if (!is_array($arr)) {
            throw new UnableToParseFile($fileObj->getFilename());
        }

        $this->ast = $arr;
        $ns = $arr[1];
        assert($ns instanceof Stmt\Namespace_);

        foreach ($ns->stmts as $stmt) {
            $this->resolveModel($stmt, $arr);
        }

        return $this;
    }

    /** @param array<\PhpParser\Node\Stmt> $stmts */
    protected function resolveModel(Stmt $stmt, array $stmts): void
    {
        switch ($stmt) {
            case $stmt instanceof Stmt\Class_:
                $this->model = ClassModelFactory::create($stmts);

                break;

            case $stmt instanceof Stmt\Interface_:
                $this->model = InterfaceModelFactory::create($stmts);

                break;

            case $stmt instanceof Stmt\Trait_:
                $this->model = TraitModelFactory::create($stmts);

                break;

            default:
                break;
        }
    }
}
