<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;
use Gefud\Generator\NamedDefinition;

class VariableDefinition implements Definition, NamedDefinition
{
    /**
     * @var string Property name
     */
    protected $name;
    /**
     * @var string|ClassDefinition Property type
     */
    protected $type;
    /**
     * @var mixed Property value
     */
    protected $value;

    /**
     * Property definition constructor
     * @param string $name Property name
     * @param string $type Property type
     * @param null $value Property value
     */
    public function __construct($name, $type = 'unknown', $value = null)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value = $value;
    }

    /**
     * Get property name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Exports property value as string
     * @return string
     */
    public function exportValue()
    {
        return var_export($this->value, true);
    }

    /**
     * Get property type
     * @return string|ClassNameDefinition
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get property value
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Check if variable type is scalar type
     * @return bool
     */
    public function isScalar()
    {
        return $this->getType() instanceof ClassNameDefinition;
    }

    public static function createFrom($from)
    {
        // TODO: Implement createFrom() method.
    }

    public function getText()
    {
        // TODO: Implement getText() method.
    }
}