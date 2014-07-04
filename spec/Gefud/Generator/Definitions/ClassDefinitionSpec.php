<?php

namespace spec\Gefud\Generator;

require_once __DIR__ . '/../../Test/Employee.php';

use Gefud\Generator\MethodDefinition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Gefud\Generator\PropertyDefinition;

class ClassDefinitionSpec extends ObjectBehavior
{
    const VALID_CLASSNAME = 'Employee';
    const VALID_NAMESPACE = 'Test';
    const VALID_METHODNAME = 'getName';
    const VALID_PROPERTYNAME = 'name';
    const VALID_PROPERTYTYPE = 'int';

    function let(
        PropertyDefinition $propertyName,
        MethodDefinition $methodGetName
    )
    {
        $this->beConstructedWith(self::VALID_CLASSNAME, self::VALID_NAMESPACE);

        $propertyName->beConstructedWith([
            self::VALID_PROPERTYNAME,
            self::VALID_PROPERTYTYPE,
        ]);

        $methodGetName->beConstructedWith([
            self::VALID_METHODNAME,
        ]);
        $methodGetName->getName()->willReturn('getName');
    }

    function it_generates_class_definition_object_from_class_name()
    {
        $prophecy = self::createFrom(self::VALID_NAMESPACE . '\\' . self::VALID_CLASSNAME);
        $prophecy->shouldHaveType('Gefud\Generator\ClassDefinition');
    }

    function it_can_return_valid_class_name()
    {
        $this->getName()->shouldReturn(self::VALID_CLASSNAME);
    }

    function it_can_return_valid_namespace()
    {
        $this->getNamespace()->shouldReturn(self::VALID_NAMESPACE);
    }

    function it_add_property_definitions(PropertyDefinition $propertyName)
    {
        $this->addProperty($propertyName);
    }

    function it_add_method_definitions(MethodDefinition $methodGetName)
    {
        $this->addMethod($methodGetName);
        $this->getMethod(self::VALID_METHODNAME)->shouldReturn($methodGetName);
    }

}
