<?php

/**
 * AbstractModel
 *
 * @category PhpPlantUML\PlantUML\Model
 * @package PhpPlantUML\PlantUML\Model
 * @author Daniel Tlach <daniel@tlach.cz>
 * @copyright danaketh, s.r.o.
 * @license https://choosealicense.com/licenses/mit/ MIT License
 * @link https://github.com/danaketh/php-plantuml
 */

declare(strict_types=1);

namespace PhpPlantUML\PlantUML\Model;

use Ds\Vector;
use PhpPlantUML\PlantUML\Model\Node\DeclareNode;
use PhpPlantUML\PlantUML\Model\Node\NamespaceNode;

abstract class AbstractModel implements Model
{
    protected NamespaceNode $namespace;

    protected DeclareNode $declare;

    /**
     * @var \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\UseNode>
     */
    protected Vector $usedClasses;

    protected string $name;

    /**
     * @var \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\MethodNode>
     */
    protected Vector $methods;

    /**
     * @var \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\PropertyNode>
     */
    protected Vector $properties;

    /**
     * @var \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\ConstantNode>
     */
    protected Vector $constants;

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\UseNode>
     */
    public function getUsedClasses(): Vector
    {
        return $this->usedClasses;
    }

    /**
     * @param \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\UseNode> $usedClasses
     */
    public function setUsedClasses(Vector $usedClasses): self
    {
        $this->usedClasses = $usedClasses;

        return $this;
    }

    public function getFQN(): string
    {
        return $this->namespace->toString() . '\\' . $this->name;
    }

    public function getSafeFQN(): string
    {
        return $this->namespace->toSafeString() . '_' . $this->name;
    }

    public function getDeclare(): DeclareNode
    {
        return $this->declare;
    }

    public function setDeclare(DeclareNode $node): self
    {
        $this->declare = $node;

        return $this;
    }

    public function getNamespace(): NamespaceNode
    {
        return $this->namespace;
    }

    public function setNamespace(NamespaceNode $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\MethodNode>
     */
    public function getMethods(): Vector
    {
        return $this->methods;
    }

    /**
     * @param \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\MethodNode> $methods
     */
    public function setMethods(Vector $methods): self
    {
        $this->methods = $methods;

        return $this;
    }

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\PropertyNode>
     */
    public function getProperties(): Vector
    {
        return $this->properties;
    }

    /**
     * @param \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\PropertyNode> $properties
     */
    public function setProperties(Vector $properties): self
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\ConstantNode>
     */
    public function getConstants(): Vector
    {
        return $this->constants;
    }

    /**
     * @param \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\ConstantNode> $constants
     */
    public function setConstants(Vector $constants): self
    {
        $this->constants = $constants;

        return $this;
    }
}
