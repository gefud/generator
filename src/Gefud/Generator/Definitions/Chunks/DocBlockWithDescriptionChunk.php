<?php
namespace Gefud\Generator\Definitions\Chunks;

use Gefud\Generator\Definitions\AnnotationDefinition;

class DocBlockWithDescriptionChunkChunk extends DocBlockWithoutDescriptionChunk
{
    public function getText()
    {
        $annotations = $this->docblock->getAnnotations();
        $annotationsText = "";
        /** @var AnnotationDefinition $annotation */
        foreach ($annotations as $i => $annotation) {
            $annotationsText .= $annotation->getText() . ($i + 1 < sizeof($annotations) ? "\n    * " : null);
        }
        return sprintf(self::PATTERN, $this->docblock->getDescription() . "\n     * " . $annotationsText);
    }
}