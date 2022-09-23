<?php

/**
 * ParameterItem
 *
 * @category PhpPlantUML\PlantUML\Model\Item
 * @package PhpPlantUML\PlantUML\Model\Item
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\Model\Item;

use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Identifier;
use PhpParser\Node\Param;
use function assert;

final class ParameterItem
{
    protected string $name;

    protected string $type;

    protected mixed $default;

    public function __construct(Param $param)
    {
        assert($param->var instanceof Variable);
        assert($param->type instanceof Identifier);
        $this->name = is_string($param->var->name)
            ? $param->var->name
            : '';
        $this->type = $param->type->name;
        $this->default = $param->default;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDefault(): mixed
    {
        return $this->default;
    }
}
