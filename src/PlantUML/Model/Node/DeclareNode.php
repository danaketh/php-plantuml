<?php

/**
 * DeclareNode
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

use Ds\Vector;
use PhpParser\Node\Stmt\Declare_;
use PhpPlantUML\PlantUML\Model\Item\DeclarationItem;

final class DeclareNode
{
    /**
     * @var \Ds\Vector<\PhpPlantUML\PlantUML\Model\Item\DeclarationItem>
     */
    protected Vector $declarations;

    public function __construct(?Declare_ $stmt = null)
    {
        $this->declarations = new Vector;

        if ($stmt === null) {
            return;
        }

        foreach ($stmt->declares as $declare) {
            $this->declarations->push(new DeclarationItem($declare));
        }
    }

    /**
     * @return array<\PhpPlantUML\PlantUML\Model\Item\DeclarationItem>
     */
    public function toArray(): array
    {
        return $this->declarations->toArray();
    }

    public function count(): int
    {
        return $this->declarations->count();
    }

    public function find(string $name): ?DeclarationItem
    {
        return $this->declarations->filter(static function (DeclarationItem $item) use ($name): bool {
            return $item->getName() === $name;
        })->first();
    }
}
