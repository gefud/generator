<?php

namespace spec\Gefud\Generator\Definitions;

use Gefud\Generator\Annotations\VarAnnotationDefinition;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class DocBlockDefinitionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Additional document description', [
            VarAnnotationDefinition::createFrom('@var integer Property description')
        ]);
    }

    function it_creates_property_instance_from_docblock()
    {
        $this::createFrom("/**\n     * @var integer Property description\n     */")
            ->shouldHaveType('Gefud\Generator\Definitions\DocBlockDefinition');
    }

    function it_checks_var_annotations_exists_on_hasAnnotations()
    {
        $this->hasAnnotations('var')->shouldReturn(true);
    }

    function it_gets_var_annotations_on_getAnnotations()
    {
        $this->getAnnotations('var')[0]->getToken()->shouldReturn('var');
    }

    function it_sets_description_as_property_description()
    {
        $this->getDescription()->shouldReturn('Additional document description');
    }
}
