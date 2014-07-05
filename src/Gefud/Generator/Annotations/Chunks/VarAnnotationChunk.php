<?php
namespace Gefud\Generator\Annotations\Chunks;

use Gefud\Generator\Annotations\VarAnnotationDefinition;
use Gefud\Generator\Chunk;

/**
 * Class VarAnnotationChunk
 * @package Gefud\Generator\Annotations\Chunks
 */
class VarAnnotationChunk implements Chunk
{
    /**
     * Text pattern
     */
    const PATTERN = '@var %s %s';
    /**
     * @var \Gefud\Generator\Annotations\VarAnnotationDefinition Var annotation
     */
    private $annotation;

    /**
     * Var annotation chunk constructor
     * @param VarAnnotationDefinition $annotation
     */
    public function __construct(VarAnnotationDefinition $annotation)
    {
        $this->annotation = $annotation;
    }

    /**
     * Get annotation text
     * @return string
     */
    public function getText()
    {
        return sprintf(self::PATTERN, $this->annotation->getType(), $this->annotation->getDescription());
    }
} 