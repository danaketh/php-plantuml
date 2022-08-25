<?php

/**
 * Node
 *
 * @category PhpPlantUML\PlantUML\Node
 * @package PhpPlantUML\PlantUML\Node
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\Node;

use PhpParser\Node\Stmt;

final class Node
{
    protected NamespaceNode $namespace;

    protected DeclareNode $declare;

    protected ClassNode $class;

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     */
    public function __construct(array $nodes)
    {
        $this->walk($nodes);
    }

    public function getDeclare(): DeclareNode
    {
        return $this->declare;
    }

    public function getNamespace(): NamespaceNode
    {
        return $this->namespace;
    }

    public function getClass(): ClassNode
    {
        return $this->class;
    }

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     */
    protected function walk(array $nodes): void
    {
        foreach ($nodes as $node) {
            $this->assign($node);
        }
    }

    protected function assign(Stmt $node): void
    {
        switch ($node::class) {
            case Stmt\Namespace_::class:
                $this->namespace = new NamespaceNode($node);
                $this->walk($node->stmts);

                break;

            case Stmt\Declare_::class:
                $this->declare = new DeclareNode($node);

                break;

            case Stmt\Use_::class:
                $this->walk($node->uses);

                break;

            case Stmt\UseUse::class:
                $this->namespace->addUse($node);

                break;

            case Stmt\Class_::class:
                $this->class = new ClassNode($node, $this->namespace);

                break;

            default:
                break;
        }
    }
}
