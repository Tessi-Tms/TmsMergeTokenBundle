<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle\Processor;

use Tms\Bundle\MergeTagBundle\Model\Tag;

interface ProcessorInterface
{
    /**
     * Process
     *
     * @param  string $token
     * @return Tag    The tag associated with the given token
     */
    public function process($token);
}
