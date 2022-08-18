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

use PhpPlantUML\PlantUML\Node\Node;

final class PlantUML
{
    protected Crawler $crawler;

    public function __construct(string $fileName)
    {
        $this->crawler = new Crawler($fileName);
    }

    public function setBasePath(string $basePath): self
    {
        $this
            ->crawler
            ->setBasePath($basePath);

        return $this;
    }

    public function getAst(): string
    {
        return $this->crawler->getAst();
    }

    public function getPlantUml(): string
    {
        // To be implemented
    }

    public function accessNode(): Node
    {
        return $this->crawler->getNode();
    }

    public function createAstFileName(): string
    {
        return sprintf('%s.ast', $this->createFileName());
    }

    public function createFileName(): string
    {
        return sprintf(
            '%s_%s',
            $this->crawler->getNode()->getNamespace()->getSafeNamespace(),
            '-',
        );
    }
}
