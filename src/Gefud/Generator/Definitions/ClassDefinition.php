<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;
use Gefud\Generator\NamedDefinition;
use ReflectionClass;
use InvalidArgumentException;

/**
 * Class ClassDefinition
 * @package Gefud\Generator
 */
class ClassDefinition implements Definition, NamedDefinition
{
    /**
     * @var string Class short name
     */
    private $name;
    /**
     * @var string Class namespace
     */
    private $namespace;
    /**
     * @var ClassDefinition Extending class definition
     */
    private $extends;
    /**
     * @var array Class implementing interface definitions
     */
    private $interfaces = [];
    /**
     * @var array Class constant definitions
     */
    private $constants = [];
    /**
     * @var array Class propertiy definitions
     */
    private $properties = [];
    /**
     * @var array Class method definitions
     */
    private $methods = [];
    /**
     * @var DocBlockDefinition Class docblock definition
     */
    private $docblock;
    /**
     * @var bool Class final indicator
     */
    private $isFinal = false;
    /**
     * @var bool Class abstract indicator
     */
    private $isAbstract = false;
    /**
     * @var bool Class interface indicator
     */
    private $isInterface = false;
    /**
     * @var bool Class trait indicator
     */
    private $isTrait = false;

    /**
     * Class definition creation from className or ReflectionClass instance
     * @param string|ReflectionClass $from Definition source
     * @return ClassDefinition
     * @throws InvalidArgumentException
     */
    public static function createFrom($from)
    {
        if ($from instanceof ReflectionClass) {
            $classReflection = $from;
        } elseif (class_exists($from)) {
            $classReflection = new ReflectionClass($from);
        } else {
            throw new InvalidArgumentException("Couldn't reflect class: $from");
        }
        $definition = new self($classReflection->getShortName(), $classReflection->getNamespaceName());
        $parentClass = $classReflection->getParentClass();
        if ($parentClass instanceof ReflectionClass) {
            if ($parentClass instanceof ReflectionClass) {
                $definition->setExtends(ClassDefinition::createFrom($parentClass));
            }
        }
        /* @var ReflectionClass $interface */
        foreach ($classReflection->getInterfaces() as $interface) {
            if ($interface instanceof ReflectionClass) {
                $definition->addInterface(ClassDefinition::createFrom($interface));
            }
        }
        /* @var ReflectionProperty $property */
        foreach ($classReflection->getProperties() as $property) {
            $definition->addProperty(PropertyDefinition::createFrom($property));
        }
        /* @var ReflectionMethod $method */
        foreach ($classReflection->getMethods() as $method) {
            $definition->addMethod(MethodDefinition::createFrom($method));
        }

        return $definition;
    }

    /**
     * Class definition constructor
     * @param string $name Class name
     * @param string $namespace Class namespace
     */
    public function __construct($name, $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    /**
     * Set extending class definition
     * @param ClassDefinition $extends
     */
    public function setExtends(ClassDefinition $extends)
    {
        $this->extends = $extends;
    }

    /**
     * Add implementing interface definition
     * @param ClassDefinition $interface Interface definition
     */
    public function addInterface(ClassDefinition $interface)
    {
        $this->interfaces[$interface->getName()] = $interface;
    }

    /**
     * Add property definition
     * @param PropertyDefinition $property Property definition
     */
    public function addProperty(PropertyDefinition $property)
    {
        $this->properties[$property->getName()] = $property;
    }

    /**
     * Add method definition
     * @param MethodDefinition $method Method definition
     */
    public function addMethod(MethodDefinition $method)
    {
        $this->methods[$method->getName()] = $method;
    }

    /**
     * Get class name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get class namespace
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Get method definition by name
     * @param string $methodName Method name
     * @return mixed
     */
    public function getMethod($methodName)
    {
        if (true === array_key_exists($methodName, $this->methods)) {
            return $this->methods[$methodName];
        }
    }
}
