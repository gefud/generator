<?php
/**
 * Gefud
 *
 * @copyright   Copyright (c) 2014, Michał Brzuchalski
 * @license     http://opensource.org/licenses/MIT
 * @author      Michał Brzuchalski <michal.brzuchalski@gmail.com>
 */
namespace Gefud\Generator;

interface Definition
{
    public function generate()
    {
        $definition = $this->create();
        $dumper = new FileDumper($definition);

        return $dumper->dump();
    }
} 
