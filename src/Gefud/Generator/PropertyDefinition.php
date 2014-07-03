<?php
namespace Gefud\Generator;

/**
 * Class PropertyDefinition
 * @package Gefud\Generator
 */
class PropertyDefinition extends DefinitionGenerator
{
    /**
     * @var string Property name
     */
    private $name;

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
     */
    public function __construct($name)
    {
        $this->name = $name;
    }
}
