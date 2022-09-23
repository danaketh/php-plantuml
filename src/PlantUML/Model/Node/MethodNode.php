<?php

/**
 * MethodNode
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
use PhpParser\Node\ComplexType;
use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt\ClassMethod;
use PhpPlantUML\PlantUML\Model\Item\ParameterItem;
use PhpPlantUML\PlantUML\Model\Item\ReturnTypeItem;
use function assert;

final class MethodNode
{
    protected int $flags;

    protected string $name;

    /**
     * @var \Ds\Vector<\PhpPlantUML\PlantUML\Model\Item\ParameterItem>
     */
    protected Vector $parameters;

    /**
     * @var \Ds\Vector<\PhpPlantUML\PlantUML\Model\Item\ReturnTypeItem>
     */
    protected Vector $returnTypes;

    public function __construct(ClassMethod $stmt)
    {
        $this->flags = $stmt->flags;
        $this->name = $stmt->name->name;
        $this->setParameters($stmt->params);

        if ($stmt->returnType === null) {
            return;
        }

        $this->setReturnTypes($stmt->returnType);
    }

    public function getFlags(): int
    {
        return $this->flags;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Item\ParameterItem>
     */
    public function getParameters(): Vector
    {
        return $this->parameters;
    }

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Item\ReturnTypeItem>
     */
    public function getReturnTypes(): Vector
    {
        return $this->returnTypes;
    }

    protected function setReturnTypes(ComplexType|Identifier|Name $returnType): void
    {
        $this->returnTypes = new Vector;

        if ($returnType instanceof Identifier) {
            $this->returnTypes->push(new ReturnTypeItem($returnType));

            return;
        }

        if (!property_exists($returnType, 'types')) {
            return;
        }

        foreach ($returnType->types as $type) {
            assert($type instanceof Identifier);
            $this->returnTypes->push(new ReturnTypeItem($type));
        }
    }

    /**
     * @param array<\PhpParser\Node\Param> $parameters
     */
    protected function setParameters(array $parameters): void
    {
        $this->parameters = new Vector;

        foreach ($parameters as $parameter) {
            $this->parameters->push(new ParameterItem($parameter));
        }
    }
}
