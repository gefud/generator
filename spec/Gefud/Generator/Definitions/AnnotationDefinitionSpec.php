<?php

namespace spec\Gefud\Generator\Definitions;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AnnotationDefinitionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('var', ['integer', 'Integer property description']);
    }

    function it_creates_definition_from_doc_annotation()
    {
        $this::createFrom('@var integer Integer property description')->shouldHaveType('Gefud\Generator\Annotations\VarAnnotationDefinition');
    }
}
