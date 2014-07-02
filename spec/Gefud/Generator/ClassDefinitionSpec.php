<?php

namespace spec\Gefud\Generator;

require_once __DIR__ . '/../../Test/Employee.php';

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClassDefinitionSpec extends ObjectBehavior
{
    const VALID_CLASSNAME = 'Employee';
    const VALID_NAMESPACE = 'Test';

    function let()
    {
        $this->beConstructedWith(self::VALID_CLASSNAME, self::VALID_NAMESPACE);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Gefud\Generator\ClassDefinition');
    }

    function it_generates_class_definition_object_from_class_name()
    {
        $prophecy = self::createFrom(self::VALID_NAMESPACE . '\\' . self::VALID_CLASSNAME);
        $prophecy->shouldHaveType('Gefud\Generator\ClassDefinition');
    }

    function it_return_valid_class_as_class_name()
    {
        $this->getName()->willReturn(self::VALID_CLASSNAME);
    }
}
