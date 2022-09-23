<?php

/**
 * NamespaceNode
 *
 * @category PhpPlantUML\PlantUML\Model\Node
 * @package PhpPlantUML\PlantUML\Model\Node
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\Model\Node;

use PhpParser\Node\Name;
use PhpParser\Node\Stmt\Namespace_;

final class NamespaceNode
{
    protected ?string $alias = null;

    /**
     * @var string[]
     */
    protected array $parts = [];

    public function __construct(?Namespace_ $stmt = null)
    {
        if ($stmt === null) {
            return;
        }

        assert($stmt->name instanceof Name);
        $this->parts = $stmt->name->parts;
        $this->alias = $stmt->name->getAttribute('alias');
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function toString(): string
    {
        return implode('\\', $this->parts);
    }

    public function toSafeString(): string
    {
        return str_replace('\\', '_', $this->toString());
    }
}
