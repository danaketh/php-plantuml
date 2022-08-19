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

use PhpParser\Node\Stmt\Namespace_;

class ExampleClass
{
    public const CONSTANT = 'constant';

    public string $property = 'property';

    public string $publicProperty = 'publicProperty';

    protected string $protectedProperty = 'protectedProperty';

    private string $privateProperty = 'privateProperty';

    public function publicMethod(): string
    {
        return 'publicMethod';
    }

    public function getNamespaceClass(): string
    {
        return Namespace_::class;
    }

    protected function protectedMethod(): string
    {
        return 'protectedMethod';
    }

    private function privateMethod(): string
    {
        return 'privateMethod';
    }
}
