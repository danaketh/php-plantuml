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

use Generator;
use Iterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;
use SplFileInfo;

final class PlantUML
{
    /**
     * @var array<\SplFileInfo>
     */
    protected array $files = [];

    /**
     * @var array<\PhpPlantUML\PlantUML\Crawler>
     */
    protected array $crawlers= [];

    public function __construct(string $path)
    {
        $this->findFiles($path);
    }

    public function crawl(): void
    {
        foreach ($this->files as $file) {
            $this->crawlers[] = new Crawler($file);
        }
    }

    /** @return array<\PhpPlantUML\PlantUML\Crawler> */
    public function getCrawlers(): array
    {
        return $this->crawlers;
    }

    public function getModels(): Generator
    {
        foreach ($this->crawlers as $crawler) {
            yield $crawler->getModel();
        }
    }

    public function getAsts(): Iterator
    {
        foreach ($this->crawlers as $crawler) {
            yield $crawler->getAst();
        }
    }

    protected function findFiles(string $path): void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
        );
        $regexIterator = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

        foreach ($regexIterator as $file) {
            $this->files[] = new SplFileInfo($file[0]);
        }
    }
}
