<?php
namespace Gefud\Generator\Annotations;

use Gefud\Generator\Annotations\Chunks\VarAnnotationChunk;
use Gefud\Generator\Definitions\AnnotationDefinition;

/**
 * Class VarAnnotationDefinition
 * @package Gefud\Generator\Annotations
 */
class VarAnnotationDefinition extends AnnotationDefinition
{
    private $type;
    private $description;

    /**
     * Variable annotation definition constructor
     * @param array $fragments Annotation fragments
     */
    public function __construct(array $fragments)
    {
        $this->type = array_shift($fragments);
        $this->description = implode(' ', $fragments);
    }

    /**
     * Get variable type
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get variable description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get annotation token
     * @return string
     */
    public function getToken()
    {
        return 'var';
    }

    public function getText()
    {
        $chunk = new VarAnnotationChunk($this);
        return $chunk->getText();
    }
}
