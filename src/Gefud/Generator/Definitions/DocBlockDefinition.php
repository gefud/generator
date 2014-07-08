<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;
use Gefud\Generator\Definitions\Chunks\DocBlockWithDescriptionChunkChunk;
use Gefud\Generator\Definitions\Chunks\DocBlockWithoutDescriptionChunk;

/**
 * Class DocBlockDefinition
 * @package Gefud\Generator\Definitions
 */
class DocBlockDefinition implements Definition
{
    /**
     * Left bound block clearing pattern for \/**
     */
    const LEFT_PATTERN = '/^(\/[\*]+\s*\n\s+\*\s)/sU';
    /**
     * Right bound block clearing pattern for *\/
     */
    const RIGHT_PATTERN = '/(\s+[\*]+\/)$/sU';
    /**
     * Each row clearing pattern for *
     */
    const ROW_PATTERN = '/\n(\s+\*\s)/sU';
    /**
     * Description matcher pattern
     */
    const DESCRIPTION_PATTERN = '/^\s*(?<desc>[^\s@]+[^@]+)(@.*|$)/sU';
    /**
     * Annotation matcher pattern
     */
    const ANNOTATION_PATTERN = '/(?<annotation>@.*)/si';
    /**
     * @var string DocBlock description
     */
    private $description;
    /**
     * @var array Annotation definitions
     */
    private $annotations = [];

    /**
     * DocBlock definition creation from text
     * @param $from
     * @return DocBlockDefinition
     */
    public static function createFrom($from)
    {
        $from = preg_replace(self::LEFT_PATTERN, '', $from);
        $from = preg_replace(self::RIGHT_PATTERN, '', $from);
        $from = preg_replace(self::ROW_PATTERN, '', $from);

        if (preg_match(self::DESCRIPTION_PATTERN, $from, $match)) {
            $description = $match['desc'];
        } else {
            $description = null;
        }
        $annotations = [];
        if (preg_match_all(self::ANNOTATION_PATTERN, $from, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $order => $match) {
                $annotation = AnnotationDefinition::createFrom($match['annotation']);
                $annotations[] = $annotation;
            }
        }
        $definition = new self($description, $annotations);
        return $definition;
    }

    /**
     * DocBlock definition constructor
     * @param $description
     * @param array $annotations
     */
    public function __construct($description, array $annotations = [])
    {
        $this->description = $description;
        $this->annotations = $annotations;
    }

    /**
     * Get document block description
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Check annotation existance
     * @param string $token Annotation name
     * @return bool
     */
    public function hasAnnotations($token)
    {
        /** @var Annotation $annotation */
        foreach ($this->annotations as $annotation) {
            if ($token === $annotation->getToken()) {
                return true;
            }
        }
        return false;
    }

    /**
     * Get matching annotations or all when no token specified
     * @param string|bool $token Annotation token
     * @return array
     */
    public function getAnnotations($token = false)
    {
        $results = [];
        /** @var Annotation $annotation */
        foreach ($this->annotations as $annotation) {
            if ($token === false || $token === $annotation->getToken()) {
                $results[] = $annotation;
            }
        }
        return $results;
    }

    /**
     * Get definition text
     * @return string
     */
    public function getText()
    {
        if (is_null($this->getDescription())) {
            $chunk = new DocBlockWithoutDescriptionChunk($this);
        } else {
            $chunk = new DocBlockWithDescriptionChunkChunk($this);
        }
        return $chunk->getText();
    }
}
