<?php
namespace Gefud\Generator\Definitions\Chunks;

use Gefud\Generator\Chunk;
use Gefud\Generator\Definitions\ClassDefinition;

class MethodChunk implements Chunk
{
    const PATTERN = <<<EOF
    %s%s%s function %s(%s)
    {
        %s
    }

EOF;
    private $definition;

    public function __construct(ClassDefinition $definition)
    {
        $this->definition = $definition;
    }

    public function getText()
    {
        return sprintf(self::PATTERN,
            $this->definition->isAbstract() ? 'abstract ' : null,
            $this->definition->getVisibility(),
            null, // TODO: imlement static
            $this->definition->getName(),
            '$argv'
        );
    }
}