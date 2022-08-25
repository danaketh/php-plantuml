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

use PhpPlantUML\PlantUML\Node\NamespaceNode;
use PHPUnit\Framework\TestCase;

class PlantUMLTest extends TestCase
{
    public PlantUML $plantUML;

    public function setUp(): void
    {
        $this->plantUML = new PlantUML(__DIR__.'/example/ExampleClass.php');
        file_put_contents('class.ast', $this->plantUML->getAst());
    }

    public function testGetAst(): void
    {
        self::assertIsString($this->plantUML->getAst());
    }

    public function testGetDeclare(): void
    {
        $node = $this->plantUML->accessNode();
        self::assertIsArray($node->getDeclare()->getDeclarations());
        self::assertCount(1, $node->getDeclare()->getDeclarations());
        self::assertSame('strict_types', $node->getDeclare()->getDeclarations()[0]->getName());
        self::assertSame(1, $node->getDeclare()->getDeclarations()[0]->getValue());
    }

    public function testGetNamespace(): void
    {
        $node = $this->plantUML->accessNode();
        self::assertSame('PhpPlantUML\PlantUML', $node->getNamespace()->toString());
        self::assertIsArray($node->getNamespace()->getUses());
        self::assertCount(3, $node->getNamespace()->getUses());
        self::assertSame('PhpParser\Node\Stmt\Namespace_', $node->getNamespace()->getUses()[0]->toString());
    }

    public function testGetClass(): void
    {
        $node = $this->plantUML->accessNode();
        self::assertSame('ExampleClass', $node->getClass()->getName());

        self::assertIsArray($node->getClass()->getExtends());
        self::assertCount(1, $node->getClass()->getExtends());
        $extends = $node->getClass()->getExtends()[0];
        self::assertInstanceOf(NamespaceNode::class, $extends);
        self::assertSame('PhpPlantUML\PlantUML\ns\AnotherExampleClass', $extends->toString());

        self::assertIsArray($node->getClass()->getImplements());
        self::assertCount(0, $node->getClass()->getImplements());

        self::assertIsArray($node->getClass()->getConstants());
        self::assertCount(0, $node->getClass()->getConstants());

        self::assertIsArray($node->getClass()->getProperties());
        self::assertCount(0, $node->getClass()->getProperties());
    }
}
