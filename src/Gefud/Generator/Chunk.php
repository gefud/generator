<?php
namespace Gefud\Generator;

/**
 * Interface Chunk
 * @package Gefud\Generator
 */
interface Chunk
{
    /**
     * Get compiled chunk text
     * @return string
     */
    public function __toString();
} 