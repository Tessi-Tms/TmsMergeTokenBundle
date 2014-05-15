<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;

interface ProcessorInterface
{
    /**
     * Process
     *
     * @param  Token $token
     * @return string The token value
     * @throw  Tms\Bundle\MergeTokenBundle\Exception\ProcessorException
     */
    public function process(Token $token);
}
