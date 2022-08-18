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

namespace PhpPlantUML\PlantUML;

class ExampleClass
{
    public const CONSTANT = 'constant';

    public string $property = 'property';

    protected string $protectedProperty = 'protectedProperty';

    private string $privateProperty = 'privateProperty';

    public function publicMethod(): void
    {
        echo 'publicMethod';
    }

    protected function protectedMethod(): void
    {
        echo 'protectedMethod';
    }

    private function privateMethod(): void
    {
        echo 'privateMethod';
    }
}
