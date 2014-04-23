<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle;

use Tms\Bundle\MergeTagBundle\Processor\ProcessorHandler;

class Tokenizer
{
    public static $pattern    = '#\%[a-z_-]*\.[a-z_-]*(\.\{.*\})?\%#i';

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
    public function tokenize($text)
    {
        $matches = array();
        $isMatched = preg_match(self::$pattern, $text, $matches);

        if (false === $isMatched) {
            throw new \Exception('Tokenization error');
        }

        var_dump($matches); die('good');
        unset($matches[0]);

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
        $tokens = $this->tokenize($text);
        $tags   = array();
        foreach($tokens as $token) {
            $tags[$token] = $this->getProcessorHandler()->process($token);
        }
        var_dump($tags);die('TODO: Replace token with tag value');
    }
}
