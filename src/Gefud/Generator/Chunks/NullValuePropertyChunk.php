<?php
/**
 * Created by PhpStorm.
 * User: mbrzuchalski
 * Date: 03.07.14
 * Time: 16:28
 */

namespace Gefud\Generator\Chunks;


class NullValueValuePropertyChunk extends ValuePropertyChunk
{
    const PATTERN = <<<EOF
    %s $%s;
EOF;

    public function __toString()
    {
        return sprintf(self::PATTERN, $this->property->getVisibility(), $this->property->getName());
    }
} 