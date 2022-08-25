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

use PhpParser\NodeDumper;
use PhpParser\Parser;
use PhpParser\ParserFactory;
use PhpPlantUML\PlantUML\Exception\UnableToParseFile;
use PhpPlantUML\PlantUML\Exception\UnableToReadFile;
use PhpPlantUML\PlantUML\Node\Node;

final class Crawler
{
    protected string $basePath;

    protected Parser $parser;

    /**
     * @var array<\PhpParser\Node\Stmt>
     */
    protected array $ast = [];

    protected Node $node;

    public function __construct(protected string $fileName)
    {
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
    }

    public function setBasePath(string $basePath): self
    {
        $this->basePath = $basePath;

        return $this;
    }

    public function getNode(): Node
    {
        if (count($this->ast) === 0) {
            $this->parse();
        }

        return $this->node;
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
        $buffer = file_get_contents($this->fileName);

        if (!$buffer) {
            throw new UnableToReadFile($this->fileName);
        }

        $arr = $this->parser->parse($buffer);

        if (!is_array($arr)) {
            throw new UnableToParseFile($this->fileName);
        }

        $this->ast = $arr;
        $this->node = new Node($this->ast);

        return $this;
    }
}
