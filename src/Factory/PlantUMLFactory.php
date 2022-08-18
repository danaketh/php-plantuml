<?php

/**
 * PlantUMLFactory
 *
 * @category PhpPlantUML\Factory
 * @package PhpPlantUML\Factory
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\Factory;

use PhpPlantUML\PlantUML\PlantUML;

final class PlantUMLFactory
{
    public function create(string $fileName, string $sourcePath): PlantUML
    {
        return (new PlantUML($fileName))
            ->setBasePath($sourcePath);
    }
}
