<?php
namespace Gefud\Generator;

use Gefud\Generator\Definitions\ClassNameDefinition;

class Import
{
    private $include = [];
    private $exclude = [];

    public function __construct(array $exclude = [])
    {
        $this->exclude = $exclude;
    }

    public function addClassName(ClassNameDefinition $className)
    {
        if (!$this->isExcluded($className)) {
            $this->include[] = $className;
        }
    }

    public function getClassNames()
    {
        return $this->include;
    }

    public function addExcludedClassName(ClassNameDefinition $excludedClassName)
    {
        $this->exclude[] = $excludedClassName;
    }

    public function getExcludedClassNames()
    {
        return $this->exclude;
    }

    public function isExcluded(ClassNameDefinition $className)
    {
        /** @var ClassNameDefinition $excludedClassName */
        foreach ($this->getExcludedClassNames() as $excludedClassName) {
            if ($className->getFullyQualifiedClassName() === $excludedClassName->getFullyQualifiedClassName()) {
                return true;
            }
        }
        return false;
    }
}
