<?php
namespace Gefud\Generator\Definitions;

use Gefud\Generator\Annotation;
use Gefud\Generator\Definition;

class AnnotationDefinition implements Definition, Annotation
{
    const ANNOTATION_PATTERN = '/@(?<token>[^@]+)\s+(?<fragments>[^@]+)?(\n|$)/sU';
    const ANNOTATION_CLASS_PATTERN = "\\Gefud\\Generator\\Annotations\\%sAnnotationDefinition";

    private $token;
    private $fragments;

    public static function createFrom($from)
    {
        if (preg_match(self::ANNOTATION_PATTERN, $from, $match)) {
            $annotationClass = sprintf(self::ANNOTATION_CLASS_PATTERN, ucfirst($match['token']));
            $fragments = preg_split('/\s/s', $match['fragments']);
            $definition = new $annotationClass($fragments);
            return $definition;
        }
        throw new \InvalidArgumentException("Unrecognized annotation format, given: $from");
    }

    /**
     * Get annotation token
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    public function __construct($token, $fragments)
    {
        $this->token = $token;
        $this->fragments = $fragments;
    }
}
