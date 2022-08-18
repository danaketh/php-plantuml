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
use PhpParser\Node\Stmt\Namespace_;

final class Node
{
    protected NamespaceNode $namespace;

    protected DeclareNode $declare;

    /**
     * @param array<\PhpParser\Node\Stmt> $nodes
     */
    public function __construct(array $nodes)
    {
        foreach ($nodes as $node) {
            switch ($node::class) {
                case Namespace_::class:
                    $this->namespace = new NamespaceNode($node);

                    break;

                case Stmt\Declare_::class:
                    $this->declare = new DeclareNode($node);

                    break;
            }
        }
    }

    public function getDeclare(): DeclareNode
    {
        return $this->declare;
    }

    public function getNamespace(): NamespaceNode
    {
        return $this->namespace;
    }
}
