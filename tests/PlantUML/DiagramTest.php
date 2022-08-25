<?php
/**
 * DiagramTest
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

class DiagramTest extends TestCase
{
    public PlantUML $plantUML;

    public function setUp(): void
    {
        $this->plantUML = new PlantUML(__DIR__.'/example/ExampleClass.php');
        file_put_contents('class.ast', $this->plantUML->getAst());
    }

    public function testClass(): void
    {

    }
}
