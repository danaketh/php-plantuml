<?php

/**
 * NamespaceNode
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

use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use function assert;

final class NamespaceNode
{
    /**
     * @var array<string>
     */
    protected array $parts;

    /**
     * @var array<\PhpPlantUML\PlantUML\Node\NamespaceNode>
     */
    protected array $uses = [];

    protected ?string $alias = null;

    public function __construct(Stmt\Namespace_|Stmt\UseUse $node)
    {
        assert($node->name instanceof Name);
        $this->parts = $node->name->parts;
        $this->alias = $node->name->getAttribute('alias');
    }

    public function toString(): string
    {
        return implode('\\', $this->parts);
    }

    public function toSafeString(): string
    {
        return str_replace('\\', '_', $this->toString());
    }

    public function addUse(Stmt\UseUse $node): void
    {
        $this->uses[] = new NamespaceNode($node);
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    /**
     * @return array<\PhpPlantUML\PlantUML\Node\NamespaceNode>
     */
    public function getUses(): array
    {
        return $this->uses;
    }

    public function findUse(string $name): ?NamespaceNode
    {
        foreach ($this->uses as $use) {
            if ($this->getAlias() === $name || str_ends_with($use->toString(), $name)) {
                return $use;
            }
        }

        return null;
    }
}
