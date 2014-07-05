<?php
namespace Gefud\Generator\Definitions\Chunks;

class NullValuePropertyChunk extends ValuePropertyChunk
{
    const PATTERN = <<<EOF
    %s
    %s $%s;

EOF;

    public function getText()
    {
        return sprintf(self::PATTERN,
            trim($this->docblock->getText()),
            $this->property->getVisibility(),
            $this->property->getName()
        );
    }
} 