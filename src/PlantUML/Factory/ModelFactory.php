<?php

/**
 * ModelFactory
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

use Ds\Vector;
use PhpParser\Node\Identifier;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\ClassConst;
use PhpParser\Node\Stmt\ClassMethod;
use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\Interface_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Property;
use PhpParser\Node\Stmt\Trait_;
use PhpParser\Node\Stmt\Use_;
use PhpPlantUML\PlantUML\Exception\UnableToDetermineName;
use PhpPlantUML\PlantUML\Model\Node\ConstantNode;
use PhpPlantUML\PlantUML\Model\Node\DeclareNode;
use PhpPlantUML\PlantUML\Model\Node\MethodNode;
use PhpPlantUML\PlantUML\Model\Node\NamespaceNode;
use PhpPlantUML\PlantUML\Model\Node\PropertyNode;
use PhpPlantUML\PlantUML\Model\Node\UseNode;

abstract class ModelFactory
{
    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     */
    protected static function getDeclare(array $nodes): DeclareNode
    {
        foreach ($nodes as $node) {
            if ($node instanceof Declare_) {
                return new DeclareNode($node);
            }
        }

        return new DeclareNode;
    }

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     */
    protected static function getNamespace(array $nodes): NamespaceNode
    {
        foreach ($nodes as $node) {
            if ($node instanceof Namespace_) {
                return new NamespaceNode($node);
            }
        }

        return new NamespaceNode;
    }

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     */
    protected static function getName(array $nodes): string
    {
        foreach ($nodes as $node) {
            if (!($node instanceof Namespace_)) {
                continue;
            }

            foreach ($node->stmts as $stmt) {
                if ($stmt instanceof Class_ || $stmt instanceof Interface_ || $stmt instanceof Trait_) {
                    assert($stmt->name instanceof Identifier);

                    return $stmt->name->name;
                }
            }
        }

        throw new UnableToDetermineName;
    }

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\UseNode>
     */
    protected static function getUsedClasses(array $nodes): Vector
    {
        $vector = new Vector;

        foreach ($nodes as $node) {
            if (!($node instanceof Namespace_)) {
                continue;
            }

            foreach ($node->stmts as $stmt) {
                if (!($stmt instanceof Use_)) {
                    continue;
                }

                foreach ($stmt->uses as $use) {
                    $vector->push(new UseNode($use));
                }
            }
        }

        return $vector;
    }

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\MethodNode>
     */
    protected static function getMethods(array $nodes): Vector
    {
        $vector = new Vector;

        foreach ($nodes as $node) {
            if (!($node instanceof Namespace_)) {
                continue;
            }

            foreach ($node->stmts as $stmt) {
                if (!($stmt instanceof Class_) && !($stmt instanceof Interface_) && !($stmt instanceof Trait_)) {
                    continue;
                }

                foreach ($stmt->stmts as $classStmt) {
                    if (!($classStmt instanceof ClassMethod)) {
                        continue;
                    }

                    $vector->push(new MethodNode($classStmt));
                }
            }
        }

        return $vector;
    }

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\PropertyNode>
     */
    protected static function getProperties(array $nodes): Vector
    {
        $vector = new Vector;

        foreach ($nodes as $node) {
            if (!($node instanceof Namespace_)) {
                continue;
            }

            foreach ($node->stmts as $stmt) {
                if (!($stmt instanceof Class_) && !($stmt instanceof Interface_) && !($stmt instanceof Trait_)) {
                    continue;
                }

                foreach ($stmt->stmts as $classStmt) {
                    if (!($classStmt instanceof Property)) {
                        continue;
                    }

                    $vector->push(new PropertyNode($classStmt));
                }
            }
        }

        return $vector;
    }

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\ConstantNode>
     */
    protected static function getConstants(array $nodes): Vector
    {
        $vector = new Vector;

        foreach ($nodes as $node) {
            if (!($node instanceof Namespace_)) {
                continue;
            }

            foreach ($node->stmts as $stmt) {
                if (!($stmt instanceof Class_) && !($stmt instanceof Interface_) && !($stmt instanceof Trait_)) {
                    continue;
                }

                foreach ($stmt->stmts as $classStmt) {
                    if (!($classStmt instanceof ClassConst)) {
                        continue;
                    }

                    $vector->push(new ConstantNode($classStmt));
                }
            }
        }

        return $vector;
    }
}
