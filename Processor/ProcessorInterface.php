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
     * @param  string $token
     * @return Token  The Token associated with the given token
     */
    public function process($token);
}
