<?php
/**
 * PlantUMLTest
 *
 * @category  PhpPlantUML\PlantUML
 * @package   PhpPlantUML\PlantUML
 * @author    Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license   https://choosealicense.com/licenses/mit/ MIT License
 * @link      https://github.com/danaketh/php-plantuml
 */

namespace PhpPlantUML\PlantUML;

use PhpPlantUML\PlantUML\Model\Model;
use PhpPlantUML\PlantUML\ns\AnotherExampleClass;
use PHPUnit\Framework\TestCase;

class PlantUMLTest extends TestCase
{
    public PlantUML $plantUML;

    public function setUp(): void
    {
        $this->plantUML = new PlantUML(__DIR__.'/example');
        $this->plantUML->crawl();
    }

    public function testGetNodes(): void
    {
        $i = 0;

        foreach ($this->plantUML->getModels() as $model) {
            self::assertInstanceOf(Model::class, $model);
            $i++;
        }

        self::assertEquals(5, $i);
    }

    public function testGetAst(): void
    {
        foreach ($this->plantUML->getAsts() as $ast) {
            self::assertIsString($ast);
        }
    }

    public function testGetDeclare(): void
    {
        foreach ($this->plantUML->getModels() as $model) {
            self::assertSame(1, $model->getDeclare()->count());
            self::assertSame(1, $model->getDeclare()->find('strict_types')->getValue());
        }
    }

    public function testGetName(): void
    {
        $names = [
            'AnotherExampleClass',
            'ExampleAbstractClass',
            'ExampleClass',
            'ExampleInterface',
            'ExampleTrait',
        ];
        $fqns = [
            AnotherExampleClass::class,
            ExampleAbstractClass::class,
            ExampleClass::class,
            ExampleInterface::class,
            ExampleTrait::class,
        ];
        $safeFqns = [
            'PhpPlantUML_PlantUML_ns_AnotherExampleClass',
            'PhpPlantUML_PlantUML_ExampleAbstractClass',
            'PhpPlantUML_PlantUML_ExampleClass',
            'PhpPlantUML_PlantUML_ExampleInterface',
            'PhpPlantUML_PlantUML_ExampleTrait',
        ];

        foreach ($this->plantUML->getModels() as $model) {
            self::assertContains($model->getName(), $names);
            self::assertContains($model->getFqn(), $fqns);
            self::assertContains($model->getSafeFqn(), $safeFqns);
        }
    }

    public function testGetNamespace(): void
    {
        foreach ($this->plantUML->getModels() as $model) {
            if ($model->getName() === 'AnotherExampleClass') {
                self::assertSame('PhpPlantUML\PlantUML\ns', $model->getNamespace()->toString());
                self::assertSame('PhpPlantUML_PlantUML_ns', $model->getNamespace()->toSafeString());
            } else {
                self::assertSame('PhpPlantUML\PlantUML', $model->getNamespace()->toString());
                self::assertSame('PhpPlantUML_PlantUML', $model->getNamespace()->toSafeString());
            }
        }
    }

    public function testGetUsedClasses(): void
    {
        foreach ($this->plantUML->getModels() as $model) {
            if ($model->getName() === 'AnotherExampleClass') {
                self::assertSame(1, $model->getUsedClasses()->count());
            } elseif ($model->getName() === 'ExampleClass') {
                self::assertSame(3, $model->getUsedClasses()->count());
            } else {
                self::assertSame(0, $model->getUsedClasses()->count());
            }
        }
    }

    public function testInterfaceModel(): void
    {
        foreach ($this->plantUML->getModels() as $model) {
            if ($model->getName() !== 'ExampleInterface') {
                continue;
            }

            self::assertSame('ExampleInterface', $model->getName());
            self::assertSame('PhpPlantUML\PlantUML\ExampleInterface', $model->getFqn());
            self::assertSame('PhpPlantUML_PlantUML_ExampleInterface', $model->getSafeFqn());
            self::assertSame('PhpPlantUML\PlantUML', $model->getNamespace()->toString());
            self::assertSame('PhpPlantUML_PlantUML', $model->getNamespace()->toSafeString());
            self::assertSame(0, $model->getUsedClasses()->count());
            self::assertSame(1, $model->getDeclare()->count());
            self::assertSame(1, $model->getDeclare()->find('strict_types')->getValue());
            self::assertSame(1, $model->getMethods()->count());
            self::assertSame('publicMethod', $model->getMethods()->first()->getName());
            self::assertSame(2, $model->getMethods()->first()->getParameters()->count());
            self::assertSame('string', $model->getMethods()->first()->getParameters()->first()->getType());
        }
    }

    public function testTraitModel(): void
    {
        foreach ($this->plantUML->getModels() as $model) {
            if ($model->getName() !== 'ExampleTrait') {
                continue;
            }

            self::assertSame('ExampleTrait', $model->getName());
            self::assertSame('PhpPlantUML\PlantUML\ExampleTrait', $model->getFqn());
            self::assertSame('PhpPlantUML_PlantUML_ExampleTrait', $model->getSafeFqn());
            self::assertSame('PhpPlantUML\PlantUML', $model->getNamespace()->toString());
            self::assertSame('PhpPlantUML_PlantUML', $model->getNamespace()->toSafeString());
            self::assertSame(0, $model->getUsedClasses()->count());
            self::assertSame(1, $model->getDeclare()->count());
            self::assertSame(1, $model->getDeclare()->find('strict_types')->getValue());
            self::assertSame(1, $model->getMethods()->count());
            self::assertSame('traitMethod', $model->getMethods()->first()->getName());
            self::assertSame(0, $model->getMethods()->first()->getParameters()->count());
            self::assertSame(0, $model->getProperties()->count());
        }
    }

    public function testClassModel(): void
    {
        foreach ($this->plantUML->getModels() as $model) {
            if ($model->getName() !== 'ExampleClass') {
                continue;
            }

            self::assertSame('ExampleClass', $model->getName());
            self::assertSame('PhpPlantUML\PlantUML\ExampleClass', $model->getFqn());
            self::assertSame('PhpPlantUML_PlantUML_ExampleClass', $model->getSafeFqn());
            self::assertSame('PhpPlantUML\PlantUML', $model->getNamespace()->toString());
            self::assertSame('PhpPlantUML_PlantUML', $model->getNamespace()->toSafeString());
            self::assertSame(3, $model->getUsedClasses()->count());
            self::assertSame(1, $model->getDeclare()->count());
            self::assertSame(1, $model->getDeclare()->find('strict_types')->getValue());
            self::assertSame(5, $model->getMethods()->count());
            self::assertSame('publicMethod', $model->getMethods()->first()->getName());
            self::assertSame(2, $model->getMethods()->first()->getParameters()->count());
            self::assertSame(4, $model->getProperties()->count());
            self::assertSame(3, $model->getConstants()->count());
        }
    }
}
