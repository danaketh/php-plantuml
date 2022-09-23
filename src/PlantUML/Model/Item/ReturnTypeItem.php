<?php

/**
 * ReturnTypeItem
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

use PhpParser\Node\Identifier;

final class ReturnTypeItem
{
    protected string $type;

    public function __construct(Identifier $type)
    {
        $this->type = $type->name;
    }

    public function getType(): string
    {
        return $this->type;
    }
}
