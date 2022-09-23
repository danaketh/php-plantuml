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
use PhpParser\Node\Stmt\Class_;
use PhpPlantUML\PlantUML\ns\AnotherExampleClass;

final class ExampleClass extends AnotherExampleClass
{
    public const PUBLIC_CONSTANT = 'constant';

    protected const PROTECTED_CONSTANT = 'protected constant';

    private const PRIVATE_CONSTANT = 'private constant';

    public string $property = 'property';

    public string $publicProperty = 'publicProperty';

    protected string $protectedProperty = 'protectedProperty';

    private string $privateProperty = 'privateProperty';

    public function publicMethod(string $param1, int $param2): string|null
    {
        return 'publicMethod';
    }

    public function getNamespaceUse(): string
    {
        return Namespace_::class;
    }

    public function getClassUse(): string
    {
        return Class_::class;
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
