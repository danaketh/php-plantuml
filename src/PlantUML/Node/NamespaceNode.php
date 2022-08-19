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

use PhpParser\Node\Stmt;

final class NamespaceNode
{
    /**
     * @var array<string>
     */
    protected array $parts;

    /**
     * @var array<NamespaceNode>
     */
    protected array $uses = [];

    /**
     * @param string[] $parts
     */
    public function __construct(array $parts)
    {
        $this->parts = $parts;
    }

    public function toString(): string
    {
        return implode('\\', $this->parts);
    }

    public function toSafeString(): string
    {
        return str_replace('\\', '_', $this->toString());
    }

    /**
     * @param string[] $parts
     */
    public function addUse(array $parts): void
    {
        $this->uses[] = new NamespaceNode($parts);
    }

    /**
     * @return NamespaceNode[]
     */
    public function getUses(): array
    {
        return $this->uses;
    }
}
