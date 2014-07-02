<?php
namespace Gefud\Generator;

use ReflectionClass;
use InvalidArgumentException;
use Doctrine\Common\Annotation\AnnotationReader;

class ClassDefinition extends GeneratorAware
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
        $annotationReader = new AnnotationReader()
        $annotationReader->setEnabledPhpImports(true);
        $classAnnotations = $annotationReader->getClassAnnotations($classReflection);

        $this->name = $classReflection->getShortName();
        $this->namespace = $classReflection->getNamespaceName();
        $parentClass = $classReflection->getParentClass();
        if ($parentClass instanceof ReflectionClass) {
            $this->extends = new self($parentClass);
        }
        /* @var ReflectionClass $interface */
        foreach ($classReflection->getInterfaces() as $interface) {
            $this->interfaces[] = new self($interface);
        }
        /* @var ReflectionProperty $property */
        foreach ($classReflection->getProperties() as $property) {
            $this->properties[] = PropertyDefinition::createFrom($property);
        }
        /* @var ReflectionMethod $method */
        foreach ($classReflection->getMethods() as $method) {
            $this->methods[] = MethodDefinition::createFrom($method);
        }
    }

    public function __construct($className)
    {
        $this->name = $className;
    }
}
