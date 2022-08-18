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

use PhpParser\Node\Stmt\Declare_;
use PhpParser\Node\Stmt\DeclareDeclare;
use PhpPlantUML\PlantUML\Node\Item\DeclareItem;
use function assert;

final class DeclareNode
{
    /**
     * @var array<\PhpPlantUML\PlantUML\Node\Item\DeclareItem>
     */
    protected array $declarations = [];

    public function __construct(Declare_ $node)
    {
        foreach($node->declares as $declare) {
            assert($declare instanceof DeclareDeclare);
            $this->declarations[] = new DeclareItem($declare->key->toString(), $declare->value->value);
        }
    }

    /**
     * @return array<\PhpPlantUML\PlantUML\Node\Item\DeclareItem>
     */
    public function getDeclarations(): array
    {
        return $this->declarations;
    }
}
