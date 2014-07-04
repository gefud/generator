<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 03.07.14
 * Time: 16:13
 */

namespace Gefud\Generator\Chunks;


use Gefud\Generator\PropertyDefinition;

class ValuePropertyChunk implements Chunk
{
    const PATTERN = <<<EOF
    %s $%s = %s;
EOF;

    private $property;

    public function __construct(PropertyDefinition $property)
    {
        $this->property = $property;
    }

    public function __toString()
    {
        return sprintf(self::PATTERN, $this->property->getName(), $this->property->exportValue());
    }
} 