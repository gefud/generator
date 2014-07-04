<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Definition;

class DocBlockDefinition implements Definition
{
    const LEFT_PATTERN = '/^(\/[\*]+\s*\n\s+\*\s)/sU';
    const RIGHT_PATTERN = '/(\s+[\*]+\/)$/sU';
    const ROW_PATTERN = '/\n(\s+\*\s)/sU';
    const DESCRIPTION_PATTERN = '/^\s*(?<desc>[^\s@]+[^@]+)(@.*|$)/sU';
    const ANNOTATION_PATTERN = '/(?<annotation>@.*)/si';

    /**
     * @var string DocBlock description
     */
    private $description;
    private $annotations = [];

    public static function createFrom($from)
    {
        //echo 'from:{', $from, '}', "\n";
        $from = preg_replace(self::LEFT_PATTERN, '', $from);
        //echo 'clean[LEFT]:{', $from, '}', "\n";
        $from = preg_replace(self::RIGHT_PATTERN, '', $from);
        //echo 'clean[RIGHT]:{', $from, '}', "\n";
        $from = preg_replace(self::ROW_PATTERN, '', $from);
        //echo 'clean[ROW]:{', $from, '}', "\n";
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
     * Get matching annotations
     * @param string $token Annotation token
     * @return array
     */
    public function getAnnotations($token)
    {
        $results = [];
        /** @var Annotation $annotation */
        foreach ($this->annotations as $annotation) {
            if ($token === $annotation->getToken()) {
                $results[] = $annotation;
            }
        }
        return $results;
    }
}
