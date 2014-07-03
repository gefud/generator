<?php
namespace Gefud\Generator;

class MethodDefinition extends DefinitionGenerator
{
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
    
    public function getName()
    {
        return $this->name;
    }

    public function __construct($name)
    {
        $this->name = $name;
    }
}
