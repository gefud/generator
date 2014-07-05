<?php

namespace spec\Gefud\Generator\Annotations;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class VarAnnotationDefinitionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['integer', 'Integer', 'property', 'description']);
    }

    function it_returns_type_on_getType()
    {
        $this->getType()->shouldReturn('integer');
    }

    function it_returns_description_on_getDescription()
    {
        $this->getDescription()->shouldReturn('Integer property description');
    }

    function it_returns_var_on_getToken()
    {
        $this->getToken()->shouldReturn('var');
    }

    function it_returns_var_annotation_text_on_getText()
    {
        $this->getText()->shouldReturn('@var integer Integer property description');
    }
}
