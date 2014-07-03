<?php
namespace Gefud\Generator;

use ReflectionClass;
use InvalidArgumentException;
use Doctrine\Common\Annotation\AnnotationReader;

class ClassDefinition extends DefinitionGenerator
{
    private $name;
    private $namespace;
    private $extends;
    private $interfaces = [];
    private $constants = [];
    private $properties = [];
    private $methods = [];
    private $docblock;
    private $imports = [];
    private $isFinal;
    private $isAbstract;
    private $isInterface;
    private $isTrait;

    public static function createFrom($from)
    {
        if ($from instanceof ReflectionClass) {
            $classReflection = $from;
        } elseif (class_exists($from)) {
            $classReflection = new ReflectionClass($from);
        } else {
            throw new InvalidArgumentException("Couldn't reflect class: $from");
        }
//        $annotationReader = new AnnotationReader();
//        $annotationReader->setEnabledPhpImports(true);
//        $classAnnotations = $annotationReader->getClassAnnotations($classReflection);

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

    public function __construct($name, $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
    }

    public function setExtends(ClassDefinition $extends)
    {
        $this->extends = $extends;
    }

    public function addInterface(ClassDefinition $interface)
    {
        $this->interfaces[$interface->getName()] = $interface;
    }

    public function addProperty(PropertyDefinition $property)
    {
        $this->properties[$property->getName()] = $property;
    }

    public function addMethod(MethodDefinition $method)
    {
        $this->methods[$method->getName()] = $method;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getMethod($methodName)
    {
//        var_dump($methodName);
        if (true === array_key_exists($methodName, $this->methods)) {
            return $this->methods[$methodName];
        }
    }
}
