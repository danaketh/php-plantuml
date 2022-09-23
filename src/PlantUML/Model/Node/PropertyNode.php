<?php

/**
 * PropertyNode
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

use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\Property;
use function assert;

final class PropertyNode
{
    protected int $flags;

    protected string $name;

    protected string $type;

    protected string $default;

    public function __construct(Property $property)
    {
        $this->flags = $property->flags;
        $this->name = $property->props[0]->name->name;

        if ($property->type instanceof Identifier) {
            $this->type = $property->type->name;
        }

        if ($property->type instanceof Name) {
            $this->type = $property->type->toString();
        }

        if (!is_array($property->props) || count($property->props) <= 0) {
            return;
        }

        assert($property->props[0]->default instanceof String_);
        $this->default = $property->props[0]->default->value;
    }
}
