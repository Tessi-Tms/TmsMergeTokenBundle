<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;

abstract class AbstractProcessor implements ProcessorInterface
{
    /**
     * Create a Token from a given token
     *
     * @param  array $token ex: array('type' => TYPE, 'field' => FIELD, ['options' => json])
     * @return Token
     */
    public static function createToken($token)
    {
        if (!isset($token['type'])) {
            throw new \Exception('Token creation error: missing type');
        }

        if (!isset($token['field'])) {
            throw new \Exception('Token creation error: missing field');
        }

        $options = array();
        if (isset($token['options'])) {
            $options = json_decode($token['options'], true);
            if (null === $options) {
                throw new \Exception('Token creation error: wrong options');
            }
        }

        return new Token(
            $token['type'],
            $token['field'],
            $options
        );
    }

    /**
     * {@inheritdoc}
     */
    public function process($token)
    {
        $Token = self::createToken($token);

        if (!$this->processToken($token)) {
            throw new \Exception('Token process failed');
        }

        return $Token;
    }

    /**
     * Process Token
     *
     * @param  Token $token
     * @return boolean true if Token value found, false if not
     */
    abstract public function processToken(Token & $token);
}
