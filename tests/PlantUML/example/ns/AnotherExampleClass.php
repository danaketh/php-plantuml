<?php

/**
 * ${NAME}
 *
 * @author    Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * @link      https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\ns;

use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Class_;
use PhpPlantUML\PlantUML\ExampleAbstractClass;

abstract class AnotherExampleClass extends ExampleAbstractClass
{
    protected function anotherFunction(): string
    {
        return 'anotherFunction';
    }
}
