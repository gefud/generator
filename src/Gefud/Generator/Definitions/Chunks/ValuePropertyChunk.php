<?php
namespace Gefud\Generator\Definitions\Chunks;

use Gefud\Generator\Chunk;
use Gefud\Generator\Definitions\DocBlockDefinition;
use Gefud\Generator\Definitions\PropertyDefinition;

class ValuePropertyChunk implements Chunk
{
    const PATTERN = <<<EOF
    %s
    %s $%s = %s;

EOF;

    /**
     * @var \Gefud\Generator\Definitions\PropertyDefinition
     */
    protected $property;
    /**
     * @var \Gefud\Generator\Definitions\DocBlockDefinition
     */
    protected $docblock;

    public function __construct(PropertyDefinition $property, DocBlockDefinition $docblock)
    {
        $this->property = $property;
        $this->docblock = $docblock;
    }

    public function getText()
    {
        return sprintf(self::PATTERN,
            trim($this->docblock->getText()),
            $this->property->getVisibility(),
            $this->property->getName(),
            $this->property->exportValue()
        );
    }
} 