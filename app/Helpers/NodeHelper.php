<?php

namespace App\Helpers;

class NodeHelper
{
    /**
     * @param $node
     * @param mixed $default
     * @param int $depth
     * @return mixed
     */
    public static function getSubNodePlainText($node, $default = null, int $depth = 0)
    {
        if (null === $node || false === is_array($node)) {
            return $default;
        }

        if (count($node) >= $depth) {
            return $default;
        }

        return $node[$depth]->plaintext;
    }

    /**
     * @param $node
     * @return bool
     */
    public static function checkNode($node): bool
    {
        if (null === $node) {
            return false;
        }

        if (0 === count($node)) {
            return false;
        }

        return true;
    }
}
