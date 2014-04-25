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
     * @param  string  $tokenRaw
     * @return Token   The processed token
     * @throw  Tms\Bundle\MergeTokenBundle\Exception\TokenException
     */
    public function process($tokenRaw);
}
