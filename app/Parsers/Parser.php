<?php

namespace App\Parsers;

abstract class Parser
{
    /**
     * @param string $text
     * @return array
     */
    public abstract function parse(string $text): array;
}
