<?php
namespace Gefud\Generator\Definitions\Chunks;

use Gefud\Generator\Chunk;
use Gefud\Generator\Definitions\ClassDefinition;

class ClassChunk implements Chunk
{
    const PATTERN = <<<EOF
%sclass %s
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
        echo sprintf(self::PATTERN,
            $this->definition->isAbstract() ? 'abstract ' : null,
            $this->definition->getName(),
            '// TODO: implement'
        );
        return sprintf(self::PATTERN,
            $this->definition->isAbstract() ? 'abstract ' : null,
            $this->definition->getName(),
            '// TODO: implement'
        );
    }
}