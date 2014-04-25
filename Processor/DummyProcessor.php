<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;

class DummyProcessor extends AbstractProcessor
{
    /**
     * {@inheritdoc}
     */
    public function processToken(Token $token)
    {
        return null;
    }
}