<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;
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

    public function setDocBlock(DocBlockDefinition $docblock)
    {
        $this->docblock = $docblock;
    }
}
