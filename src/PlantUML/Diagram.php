<?php

/**
 * Diagram
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

use PhpPlantUML\PlantUML\Model\Model;

final class Diagram
{
    protected string $start = '@startuml';

    protected string $end = '@enduml';

    public function __construct(protected Model $node)
    {
    }

    public function getClassDiagram(): string
    {
        return 'To be implemented!';
    }
}
