<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Handler;

use Tms\Bundle\MergeTokenBundle\Model\Token;
use Tms\Bundle\MergeTokenBundle\Tokenizer;
use Tms\Bundle\MergeTokenBundle\Processor\ProcessorInterface;
use Tms\Bundle\MergeTokenBundle\Exception\TokenException;
use Tms\Bundle\MergeTokenBundle\Exception\ProcessorException;

class TokenHandler
{
    protected $processors;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->processors = array();
    }

    /**
     * Add processor
     *
     * @param string             $type
     * @param AbstractProcessor  $processor
     */
    public function setProcessor($type, ProcessorInterface $processor)
    {
        $this->processors[$type] = $processor;
    }

    /**
     * Get the right Processor associated with the given type
     *
     * @param  $type
     * @return AbstractProcessor
     */
    public function getProcessor($type)
    {
        if (!isset($this->processors[$type])) {
            throw new ProcessorException(sprintf(
                'Undefined processor %s',
                $type
            ));
        }

        return $this->processors[$type];
    }

    /**
     * {@inheritdoc}
     */
    public function process(Token $token)
    {
        return $this->getProcessor($token->getType())->process($token);
    }

    /**
     * Create Token
     *
     * @param  array $tokenRaw
     * @return Token
     */
    public function createToken($tokenRaw)
    {
        if (!isset($tokenRaw['type'])) {
            throw new TokenException('Missing raw type');
        }

        if (!isset($tokenRaw['field'])) {
            throw new TokenException('Missing raw field');
        }

        $options = array();
        if (isset($tokenRaw['options'])) {
            // Merge options before json decode
            $options = $this->merge($tokenRaw['options']);

            $options = json_decode($options, true);
            if (null === $options) {
                throw new TokenException('Wrong raw options');
            }
        }

        return new Token(
            $tokenRaw[0],
            $tokenRaw['type'],
            $tokenRaw['field'],
            $options
        );
    }

    /**
     * Merge
     *
     * @param  string $text
     * @return string the merged text
     */
    public function merge($text)
    {
        $tokenRaws = Tokenizer::tokenize($text);
        foreach ($tokenRaws as $tokenRaw) {
            $token = $this->createToken($tokenRaw);
            $tokenValue = $this->process($token);
            $token->setValue($tokenValue);

            $text = str_replace($token->getRaw(), $token->getValue(), $text);
        }

        return $text;
    }
}
