<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle;

abstract class Tokenizer
{
    public static $pattern = '#\%(?P<type>[a-z_-]+)\.(?P<field>[a-z_-]+)(\.(?P<options>\{.*\}))?\%#i';

    /**
     * Tokenize
     *
     * @param  string $text
     * @return array all the finding tokens
     */
    public static function tokenize($text)
    {
        $matches = array();
        $countMatched = preg_match_all(self::$pattern, $text, $matches, PREG_SET_ORDER);

        if (false === $countMatched) {
            throw new \Exception('Tokenization error');
        }

        return $matches;
    }
}
