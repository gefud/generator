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

    function it_returns_docblock_when_set()
    {
        $this->setDocBlock(DocBlockDefinition::createFrom("/**\n     * @var integer Property description\n     */"));
        $this->getDocBlock()->shouldHaveType('\Gefud\Generator\Definitions\DocBlockDefinition');
    }

    function it_returns_property_text_on_getText()
    {
        $this->setDocBlock(DocBlockDefinition::createFrom("/**\n     * @var integer Property description\n     */"));
        $this->getText()->shouldReturn("    /**\n     * @var integer Property description\n     */\n    private \$name;\n");
    }
}
