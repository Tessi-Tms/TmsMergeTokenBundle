<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;

abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process($tokenRaw)
    {
        $token = new Token($tokenRaw);
        try {
            $token->setValue($this->processToken($token));
        } catch (\Exception $e) {
            die('WTF');
        }

        return $token;
    }

    /**
     * Process Token
     *
     * @param  Token $token
     * @return mixed The token value
     */
    abstract public function processToken(Token $token);
}
