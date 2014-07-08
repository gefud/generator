<?php

namespace spec\Gefud\Generator\Definitions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassNameDefinitionSpec extends ObjectBehavior
{
    const VALID_CLASSNAME = 'Employee';
    const VALID_NAMESPACE = 'Test';
    const VALID_ALIAS = 'EmployeeEntity';

    public function let()
    {
        $this->beConstructedWith(self::VALID_CLASSNAME, self::VALID_NAMESPACE);
    }

    function it_generates_class_definition_object_from_class_name()
    {
        $prophecy = $this::createFrom(self::VALID_NAMESPACE . '\\' . self::VALID_CLASSNAME);
        $prophecy->shouldHaveType('Gefud\Generator\Definitions\ClassNameDefinition');
    }

    function it_returns_short_name_Employee()
    {
        $this->getName()->shouldreturn(self::VALID_CLASSNAME);
    }

    function it_returns_namespace_Test()
    {
        $this->getNamespace()->shouldReturn(self::VALID_NAMESPACE);
    }

    function it_returns_FQCN_Test_Employee()
    {
        $this->getFullyQualifiedClassName()->shouldReturn(self::VALID_NAMESPACE . '\\' . self::VALID_CLASSNAME);
    }

    function it_can_set_alias_EmployeeEntity()
    {
        $this->setClassNameAlias(self::VALID_ALIAS);
        $this->getClassNameAlias()->shouldReturn(self::VALID_ALIAS);
    }

    function it_returns_class_name_without_as_text_on_getText()
    {
        $this->getText()->shouldReturn(self::VALID_NAMESPACE . '\\' . self::VALID_CLASSNAME);
    }

    function it_returns_class_name_with_EmployeeEntity_as_text_on_getText()
    {
        $this->setClassNameAlias(self::VALID_ALIAS);
        $this->getText()->shouldReturn(self::VALID_NAMESPACE . '\\' . self::VALID_CLASSNAME . ' as ' . self::VALID_ALIAS);
    }
}
