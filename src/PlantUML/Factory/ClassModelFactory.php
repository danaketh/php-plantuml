<?php

/**
 * ClassModelFactory
 *
 * @category PhpPlantUML\PlantUML\Factory
 * @package PhpPlantUML\PlantUML\Factory
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\Factory;

use PhpPlantUML\PlantUML\Model\ClassModel;

final class ClassModelFactory extends ModelFactory
{
    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     */
    public static function create(array $nodes): ClassModel
    {
        $class = new ClassModel;
        $class->setDeclare(self::getDeclare($nodes));
        $class->setNamespace(self::getNamespace($nodes));
        $class->setName(self::getName($nodes));
        $class->setUsedClasses(self::getUsedClasses($nodes));
        $class->setMethods(self::getMethods($nodes));
        $class->setProperties(self::getProperties($nodes));
        $class->setConstants(self::getConstants($nodes));

        return $class;
    }
}
