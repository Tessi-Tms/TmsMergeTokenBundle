<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle;

use Tms\Bundle\MergeTagBundle\Processor\ProcessorHandler;

class Tokenizer
{
    public static $pattern = '#\%(?P<type>[a-z_-]+)\.(?P<field>[a-z_-]+)(\.(?P<options>\{.*\}))?\%#i';

    /**
     * Constructor
     */
    public function __construct(ProcessorHandler $processorHandler)
    {
        $this->processorHandler = $processorHandler;
    }

    /**
     * Get Processor Handler
     *
     * @return ProcessorHandler
     */
    public function getProcessorHandler()
    {
        return $this->processorHandler;
    }

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

    /**
     * Merge
     *
     * @param  string $text
     * @return string the merged text
     */
    public function merge($text)
    {
        $tokens = self::tokenize($text);
        $tags   = array();
        foreach($tokens as $token) {
            $tags[$token] = $this->getProcessorHandler()->process($token);
        }
        var_dump($tags);die('TODO: Replace token with tag value');
    }
}