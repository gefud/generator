<?php

namespace spec\Gefud\Generator\Definitions;

use Gefud\Generator\Definitions\DocBlockDefinition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PropertyDefinitionSpec extends ObjectBehavior
{
    const VALID_PROPERTYNAME = 'name';

    function let()
    {
        $this->beConstructedWith(self::VALID_PROPERTYNAME);
    }

    function it_can_return_valid_propertyname()
    {
        $this->getName()->shouldReturn(self::VALID_PROPERTYNAME);
    }

    function it_sets_docblock()
    {
        $this->setDocBlock(DocBlockDefinition::createFrom("/**\n     * @var integer Property description\n     */"));
    }
}
