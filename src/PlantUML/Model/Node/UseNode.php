<?php

/**
 * UseNode
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
use PhpParser\Node\Stmt\UseUse;

final class UseNode
{
    /**
     * @var string[]
     */
    protected array $parts = [];

    protected ?string $alias = null;

    public function __construct(UseUse $stmt)
    {
        assert($stmt->name instanceof Name);
        $this->parts = $stmt->name->parts;
        $this->alias = $stmt->name->getAttribute('alias');
    }

    public function toString(): string
    {
        return implode('\\', $this->parts);
    }

    public function toSafeString(): string
    {
        return str_replace('\\', '_', $this->toString());
    }

    public function getFQN(): string
    {
        return $this->toString();
    }

    public function getSafeFQN(): string
    {
        return $this->toSafeString();
    }
}
