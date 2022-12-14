<?php

/**
 * ExampleInterface
 *
 * @category  PhpPlantUML\PlantUML\example
 * @package   PhpPlantUML\PlantUML\example
 * @author    Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * @link      https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);


namespace PhpPlantUML\PlantUML;


interface ExampleInterface
{
    public function publicMethod(string $param1, int $param2): string|null;
}
