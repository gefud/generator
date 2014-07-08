<?php
namespace Gefud\Generator\Definitions\Chunks;

use Gefud\Generator\Chunk;
use Gefud\Generator\Definitions\DocBlockDefinition;

class DocBlockWithoutDescriptionChunk implements Chunk
{
    const PATTERN = "    /**\n     * %s\n     */\n";
    /**
     * @var \Gefud\Generator\Definitions\DocBlockDefinition
     */
    protected $docblock;

    /**
     * DocBlock chunk constructor
     * @param DocBlockDefinition $docblock
     */
    public function __construct(DocBlockDefinition $docblock)
    {
        $this->docblock = $docblock;
    }

    public function getText()
    {
        $annotations = $this->docblock->getAnnotations();
        $annotationsText = "";
        /** @var AnnotationDefinition $annotation */
        foreach ($annotations as $i => $annotation) {
            $annotationsText .= $annotation->getText() . ($i + 1 < sizeof($annotations) ? "\n    * " : null);
        }
        return sprintf(self::PATTERN, $annotationsText);
    }

} 