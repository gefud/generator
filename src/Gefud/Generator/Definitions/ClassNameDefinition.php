<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;
use Gefud\Generator\Definitions\Chunks\AliasedClassNameChunk;
use Gefud\Generator\Definitions\Chunks\ClassNameChunk;
use InvalidArgumentException;
use ReflectionClass;

/**
 * Class ClassNameDefinition
 * @package Gefud\Generator\Definitions
 */
class ClassNameDefinition implements Definition
{
    /**
     * @var string Class name
     */
    private $name;
    /**
     * @var string Class name alias
     */
    private $alias;
    /**
     * @var string Class namespace
     */
    private $namespace;

    /**
     * Method creates definition from class name or ReflectionClass
     * @param string|ReflectionClass $from
     * @return ClassNameDefinition
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
        $className = new self($classReflection->getShortName(), $classReflection->getNamespaceName());
        return $className;
    }

    /**
     * Class name definition constructor
     * @param string $name Class name
     * @param string $namespace Class namespace
     */
    public function __construct($name, $namespace)
    {
        $this->name = $name;
        $this->namespace = $namespace;
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
     * Get Fully Qualified Class Name
     * @return string
     */
    public function getFullyQualifiedClassName()
    {
        return sprintf('%s\\%s', $this->getNamespace(), $this->getName());
    }

    /**
     * Get class name alias
     * @return string
     */
    public function getClassNameAlias()
    {
        return $this->alias;
    }

    /**
     * Set class name alias
     * @param string $alias Alias for class name
     */
    public function setClassNameAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * Checks if definition has nonempty class name alias
     * @return bool
     */
    public function hasClassNameAlias()
    {
        return $this->getClassNameAlias() != null;
    }

    /**
     * Get class name as text (eg. for imports)
     * @return string
     */
    public function getText()
    {
        if ($this->hasClassNameAlias()) {
            $chunk = new AliasedClassNameChunk($this);
        } else {
            $chunk = new ClassNameChunk($this);
        }

        return $chunk->getText();
    }
}
