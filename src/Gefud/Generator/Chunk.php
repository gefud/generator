<?php
namespace Gefud\Generator\Chunks;

/**
 * Interface Chunk
 * @package Gefud\Generator\Chunks
 */
interface Chunk
{
    /**
     * Get compiled chunk text
     * @return string
     */
    public function __toString();
} 