<?php

/**
 * DeclareItem
 *
 * @category PhpPlantUML\PlantUML\Node\Item
 * @package PhpPlantUML\PlantUML\Node\Item
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\Node\Item;

final class DeclareItem
{
    public function __construct(protected string $name, protected string|int|bool $value)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): string|int|bool
    {
        return $this->value;
    }
}
