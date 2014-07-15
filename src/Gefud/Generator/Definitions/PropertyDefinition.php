<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Annotations\VarAnnotationDefinition;
use Gefud\Generator\Definitions\Chunks\NullValuePropertyChunk;
use Gefud\Generator\Definitions\Chunks\ValuePropertyChunk;
use InvalidArgumentException;
use ReflectionProperty;

/**
 * Class PropertyDefinition
 * @package Gefud\Generator
 */
class PropertyDefinition extends VariableDefinition
{
    /**
     * @var string Property visibility
     */
    private $visibility;
    /**
     * @var DocBlockDefinition Property docblock
     */
    private $docblock;

    /**
     * Property definition creation from ReflectionProperty
     * @param ReflectionProperty $from Property reflection instance
     * @return PropertyDefinition
     * @throws InvalidArgumentException
     */
    public static function createFrom($from)
    {
        if ($from instanceof \ReflectionProperty) {
            $propertyReflection = $from;
        } else {
            throw new InvalidArgumentException("Couldn't reflect class: $from");
        }
        $definition = new self($propertyReflection->getName());

        $docblock = $propertyReflection->getDocComment();
        $definition->setDocBlock(DocBlockDefinition::createFrom($docblock));

        return $definition;
    }

    /**
     * Property definition constructor
     * @param string $name Property name
     * @param string $type Property type
     * @param null $value Property value
     * @param string $visibility Property visibility
     */
    public function __construct($name, $type = 'unknown', $value = null, $visibility = 'private')
    {
        parent::__construct($name, $type, $value);
        $this->visibility = $visibility;
    }

    /**
     * Get property visibility
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }

    /**
     * Set property docblock definition
     * @param DocBlockDefinition $docblock
     */
    public function setDocBlock(DocBlockDefinition $docblock)
    {
        $this->docblock = $docblock;
    }

    /**
     * Get property docblock definition
     * @return DocBlockDefinition
     */
    public function getDocBlock()
    {
        if ($this->docblock instanceof DocBlockDefinition) {
            return $this->docblock;
        } else {
            $name = ucfirst($this->getName());
            $annotation = new VarAnnotationDefinition($this->getType(), $name);
            $docblock = new DocBlockDefinition(null, [$annotation]);
            return $docblock;
        }
    }

    /**
     * Get definition text
     * @return string
     */
    public function getText()
    {
        $docblock = $this->getDocBlock();
        if (is_null($this->getValue())) {
            $chunk = new NullValuePropertyChunk($this, $docblock);
        } else {
            $chunk = new ValuePropertyChunk($this, $docblock);
        }
        return $chunk->getText();
    }

}
