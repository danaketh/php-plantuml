<?php

/**
 * Diagram
 *
 * @category  PhpPlantUML\PlantUML
 * @package   PhpPlantUML\PlantUML
 * @author    Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * @link      https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);


namespace PhpPlantUML\PlantUML;


use PhpPlantUML\PlantUML\Node\Node;

class Diagram
{
    public function __construct(protected Node $node)
    {
    }

    public function getClassDiagram(): string
    {
        return 'To be implemented!';
    }
}
