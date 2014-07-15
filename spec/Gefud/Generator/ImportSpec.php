<?php

namespace spec\Gefud\Generator;

use Gefud\Generator\Definitions\ClassNameDefinition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ImportSpec extends ObjectBehavior
{
    const VALID_EXCLUDED_CLASSNAME = 'TimeShit';
    const VALID_EXCLUDED_NAMESPACE = 'Test';
    const VALID_CLASSNAME = 'Employee';
    const VALID_NAMESPACE = 'Test';
    const VALID_ALIAS = 'EmployeeEntity';

    function it_is_initializable()
    {
        $this->shouldHaveType('Gefud\Generator\Import');
    }

    function it_collects_ClassNameDefinitions_by_addClassName()
    {
        $className = new ClassNameDefinition(self::VALID_CLASSNAME, self::VALID_NAMESPACE);
        $this->addClassName($className);
    }

    function it_returns_collected_className_on_getClassNames()
    {
        $className = new ClassNameDefinition(self::VALID_CLASSNAME, self::VALID_NAMESPACE);
        $this->addClassName($className);
        $this->getClassNames()->shouldReturn([$className]);
    }

    function it_checks_if_className_is_excluded()
    {
        $className = new ClassNameDefinition(self::VALID_EXCLUDED_CLASSNAME, self::VALID_EXCLUDED_NAMESPACE);
        $this->beConstructedWith([$className]);
        $this->isExcluded($className)->shouldReturn(true);
    }

    function it_collects_ClassNameDefinitions_if_they_are_not_excluded()
    {
        $excludedClassName = new ClassNameDefinition(self::VALID_EXCLUDED_CLASSNAME, self::VALID_EXCLUDED_NAMESPACE);
        $this->beConstructedWith([$excludedClassName]);
        $className = new ClassNameDefinition(self::VALID_CLASSNAME, self::VALID_NAMESPACE);
        $this->addClassName($excludedClassName);
        $this->addClassName($className);
        $this->getClassNames()->shouldReturn([$className]);
    }

    function it_adds_excluded_className_by_addExcludedClassName()
    {
        $excludedClassName = new ClassNameDefinition(self::VALID_EXCLUDED_CLASSNAME, self::VALID_EXCLUDED_NAMESPACE);
        $className = new ClassNameDefinition(self::VALID_CLASSNAME, self::VALID_NAMESPACE);
        $this->addExcludedClassName($excludedClassName);
        $this->addClassName($className);
        $this->getClassNames()->shouldReturn([$className]);
        $this->getClassNames()->shouldReturn([$className]);
        $this->getClassNames()->shouldReturn([$className]);
    }
}
