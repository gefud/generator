<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;
use Gefud\Generator\NamedDefinition;

/**
 * Class MethodDefinition
 * @package Gefud\Generator\Definitions
 */
class MethodDefinition implements Definition, NamedDefinition
{
    /**
     * @var string Method name
     */
    private $name;

    /**
     * Method definition creation from ReflectionMethod
     * @param ReflectionMethod $from Method reflection instance
     * @return MethodDefinition
     * @throws InvalidArgumentException
     */
    public static function createFrom($from)
    {
        if ($from instanceof \ReflectionMethod) {
            $methodReflection = $from;
        } else {
            throw new InvalidArgumentException("Couldn't reflect class: $from");
        }
        $definition = new self($methodReflection->getName());

        return $definition;
    }

    /**
     * Get method name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Method definition constructor
     * @param string $name Method name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get method text
     */
    public function getText()
    {
        // TODO: implement
    }
}
