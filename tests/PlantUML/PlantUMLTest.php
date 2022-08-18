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

use PHPUnit\Framework\TestCase;

class PlantUMLTest extends TestCase
{

    public function testGetAst(): void
    {
        $plantUML = new PlantUML(__DIR__ . '/example/class.php');
        self::assertIsString($plantUML->getAst());
    }

    public function testGetDeclare(): void
    {
        $plantUML = new PlantUML(__DIR__ . '/example/class.php');
        $node = $plantUML->accessNode();
        self::assertIsArray($node->getDeclare()->getDeclarations());
        self::assertCount(1, $node->getDeclare()->getDeclarations());
        self::assertSame('strict_types', $node->getDeclare()->getDeclarations()[0]->getName());
        self::assertSame(1, $node->getDeclare()->getDeclarations()[0]->getValue());
    }
}
