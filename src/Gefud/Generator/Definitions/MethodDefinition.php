<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;
use Gefud\Generator\Import;
use Gefud\Generator\NamedDefinition;
use InvalidArgumentException;
use ReflectionMethod;

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
     * @var array Method definition arguments
     */
    private $arguments;
    /**
     * @var string Method definition visibility
     */
    private $visibility;

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
     * @param string $visibility Method visibility
     */
    public function __construct($name, $visibility = 'private')
    {
        $this->name = $name;
        $this->visibility = $visibility;
    }

    /**
     * Get method text
     */
    public function getText()
    {
        // TODO: implement
    }

    /**
     * Add method definition argument
     * @param ArgumentDefinition $argument Argument definition to add
     */
    public function addArgument(ArgumentDefinition $argument)
    {
        $this->arguments[] = $argument;
    }

    /**
     * Get method definition arguments
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * Get class names import
     * @param Import $imports Import instance where to push class names
     * @return Import
     */
    public function getImports(Import $imports = null)
    {
        if (!($imports instanceof Import)) {
            $imports = new Import();
        }
        /** @var ArgumentDefinition $argument */
        foreach ($this->getArguments() as $argument) {
            if (!$argument->isScalar()) {
                $argumentType = $argument->getType();
                if ($argumentType instanceof ClassNameDefinition) {
                    $imports->addClassName($argumentType);
                }
            }
        }
        return $imports;
    }

    /**
     * Get method visibility
     * @return string
     */
    public function getVisibility()
    {
        return $this->visibility;
    }
}
