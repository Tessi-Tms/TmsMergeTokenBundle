<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;
use Tms\Bundle\MergeTokenBundle\Exception\TokenException;

abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process($tokenRaw)
    {
        $token = new Token($tokenRaw);
        $token->setValue($this->processToken($token));

        return $token;
    }

    /**
     * Process Token
     *
     * @param  Token $token
     * @return mixed The token value
     * @throw  Tms\Bundle\MergeTokenBundle\Exception\TokenException
     * @throw  Tms\Bundle\MergeTokenBundle\Exception\ProcessorException
     */
    abstract public function processToken(Token $token);
}
