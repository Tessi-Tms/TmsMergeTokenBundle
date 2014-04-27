<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;
use Tms\Bundle\MergeTokenBundle\Exception\ProcessorException;

class DefaultProcessor implements ProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(Token $token)
    {
        return $token->getField();
    }
}
