<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;
use Tms\Bundle\MergeTokenBundle\Exception\ProcessorException;

class DateTimeProcessor implements ProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(Token $token)
    {
        $date   = new \DateTime($token->getOption('date', 'now'));
        $method = $token->getField();

        if (!in_array($method, array('now', 'modify', 'format'))) {
            throw new ProcessorException(sprintf(
                'The %s datetime method is undefined',
                $method
            ));
        }

        if ('modify' === $method) {
            $date->modify($token->getOption('modify'));
        }

        return $date->format($token->getOption('format', \DateTime::W3C));
    }
}
