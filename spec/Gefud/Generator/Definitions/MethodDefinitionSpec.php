<?php

namespace spec\Gefud\Generator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class MethodDefinitionSpec extends ObjectBehavior
{
    const VALID_METHODNAME = 'getName';

    function let()
    {
        $this->beConstructedWith(self::VALID_METHODNAME);
    }

    function it_can_return_valid_methodname()
    {
        $this->getName()->shouldReturn(self::VALID_METHODNAME);
    }
}
