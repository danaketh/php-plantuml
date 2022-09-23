<?php

/**
 * DeclarationItem
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

use PhpParser\Node\Scalar\DNumber;
use PhpParser\Node\Scalar\LNumber;
use PhpParser\Node\Scalar\String_;
use PhpParser\Node\Stmt\DeclareDeclare;
use PhpPlantUML\PlantUML\Exception\UnknownDeclarationValueType;

final class DeclarationItem
{
    protected string $name;
    protected mixed $value;

    public function __construct(DeclareDeclare $stmt)
    {
        $this->name = $stmt->key->name;

        if ($stmt->value instanceof String_ || $stmt->value instanceof LNumber || $stmt->value instanceof DNumber) {
            $this->value = $stmt->value->value;

            return;
        }

        throw new UnknownDeclarationValueType(get_class($stmt->value));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
