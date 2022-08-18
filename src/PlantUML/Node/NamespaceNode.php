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

use PhpParser\Node\Stmt\Namespace_;

final class NamespaceNode
{
    /**
     * @var array<string>
     */
    protected array $parts;

    public function __construct(Namespace_ $node)
    {
        $this->parts = $node->name->parts ?? [];
    }

    public function getNamespace(): string
    {
        return implode('\\', $this->parts);
    }

    public function getSafeNamespace(): string
    {
        return str_replace('\\', '_', $this->getNamespace());
    }
}
