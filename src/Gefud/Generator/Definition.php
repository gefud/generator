<?php
namespace Gefud\Generator;

interface Definition
{
    public static function createFrom($from);
    public function getText();
} 
