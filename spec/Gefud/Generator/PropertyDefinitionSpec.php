<?php

namespace spec\Gefud\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropertyDefinitionSpec extends ObjectBehavior
{
    const VALID_PROPERTYNAME = 'name';

    function let()
    {
        $this->beConstructedWith(self::VALID_PROPERTYNAME);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Gefud\Generator\PropertyDefinition');
    }

    function it_can_return_valid_propertyname()
    {
        $this->getName()->shouldReturn(self::VALID_PROPERTYNAME);
    }
}
