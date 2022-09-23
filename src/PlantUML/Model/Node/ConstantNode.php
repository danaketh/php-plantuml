<?php

/**
 * ConstantNode
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

use PhpParser\Node\Scalar\DNumber;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\ClassConst;
use PhpPlantUML\PlantUML\Model\Enum\VisibilityEnum;

final class ConstantNode
{
    protected string $name;

    protected mixed $value;

    protected string $visibility;

    public function __construct(ClassConst $node)
    {
        $this->name = $node->consts[0]->name->name;

        if ($node->consts[0]->value instanceof String_
            || $node->consts[0]->value instanceof LNumber
            || $node->consts[0]->value instanceof DNumber) {
            $this->value = $node->consts[0]->value->value;
        }

        if ($node->isPublic()) {
            $this->visibility = VisibilityEnum::PUBLIC;
        } elseif ($node->isProtected()) {
            $this->visibility = VisibilityEnum::PROTECTED;
        } elseif ($node->isPrivate()) {
            $this->visibility = VisibilityEnum::PRIVATE;
        }
    }
}
