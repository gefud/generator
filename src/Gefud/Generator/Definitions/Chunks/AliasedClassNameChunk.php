<?php
namespace Gefud\Generator\Definitions\Chunks;

class AliasedClassNameChunk extends ClassNameChunk
{
    const PATTERN = <<<EOF
%s\%s as %s
EOF;

    public function getText()
    {
        $className = sprintf(self::PATTERN,
            $this->definition->getNamespace(),
            $this->definition->getName(),
            $this->definition->getClassNameAlias()
        );
        return $className;
    }
}