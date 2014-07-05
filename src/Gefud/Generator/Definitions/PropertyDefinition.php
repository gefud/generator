<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Annotations\VarAnnotationDefinition;
use Gefud\Generator\Definition;
use Gefud\Generator\Definitions\Chunks\NullValuePropertyChunk;
use Gefud\Generator\Definitions\Chunks\ValuePropertyChunk;
use Gefud\Generator\NamedDefinition;

/**
 * Class PropertyDefinition
 * @package Gefud\Generator
 */
class PropertyDefinition implements Definition, NamedDefinition
{
    /**
     * @var string Property name
     */
    private $name;
    /**
     * @var string Property type
     */
    private $type;
    /**
     * @var mixed Property value
     */
    private $value;
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
     * Get property name
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
        $this->visibility = $visibility;
    }

    /**
     * Exports property value as string
     * @return string
     */
    public function exportValue()
    {
        return var_export($this->value, true);
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
     * Get property type
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get property value
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
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
