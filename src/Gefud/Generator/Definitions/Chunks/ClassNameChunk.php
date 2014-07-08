<?php
namespace Gefud\Generator\Definitions\Chunks;

use Gefud\Generator\Chunk;
use Gefud\Generator\Definitions\ClassNameDefinition;

class ClassNameChunk implements Chunk
{
    const PATTERN = <<<EOF
%s\%s
EOF;
    protected $definition;

    public function __construct(ClassNameDefinition $definition)
    {
        $this->definition = $definition;
    }

    public function getText()
    {
        $className = sprintf(self::PATTERN,
            $this->definition->getNamespace(),
            $this->definition->getName()
        );
        return $className;
    }
}