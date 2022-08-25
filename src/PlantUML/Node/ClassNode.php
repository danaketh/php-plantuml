<?php

/**
 * ClassNode
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

use PhpParser\Node\Identifier;
use PhpParser\Node\Name;
use PhpParser\Node\Stmt;
use function assert;

final class ClassNode
{
    protected string $name;

    /**
     * @var array<(\PhpPlantUML\PlantUML\Node\NamespaceNode|string)>
     */
    protected array $extends = [];

    protected array $implements = [];

    protected array $constants = [];

    protected array $properties = [];

    public function __construct(Stmt\Class_ $node, ?NamespaceNode $namespaceNode = null)
    {
        $this->name = $node->name instanceof Identifier
            ? $node->name->name
            : '';
        assert($node->extends instanceof Name);

        foreach ($node->extends->parts as $extend) {
            $this->extends[] = $namespaceNode instanceof NamespaceNode
                ? $namespaceNode->findUse($extend)
                : $extend;
        }
    }

    public function getName(): string
    {
        return $this->name;
    }

    /** @return array<(\PhpPlantUML\PlantUML\Node\NamespaceNode|string)> */
    public function getExtends(): array
    {
        return $this->extends;
    }

    public function getImplements(): array
    {
        return $this->implements;
    }

    public function getConstants(): array
    {
        return $this->constants;
    }

    public function getProperties(): array
    {
        return $this->properties;
    }
}
