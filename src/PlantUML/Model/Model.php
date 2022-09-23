<?php

/**
 * ModelInterface
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

interface Model
{
    public function getDeclare(): DeclareNode;

    public function setDeclare(DeclareNode $node): self;

    public function getNamespace(): NamespaceNode;

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\UseNode>
     */
    public function getUsedClasses(): Vector;

    public function getFQN(): string;

    public function getSafeFQN(): string;

    /**
     * @return \Ds\Vector<\PhpPlantUML\PlantUML\Model\Node\PropertyNode>
     */
    public function getProperties(): Vector;
}
