<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;
use Tms\Bundle\MergeTokenBundle\Exception\ProcessorException;

class ObjectProcessor implements ProcessorInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(Token $token)
    {
        if (!$token->hasContext()) {
            throw new ProcessorException('Context required');
        }

        $method = $token->getField();
        $rc = new \ReflectionClass($token->getContext());
        if (!$rc->hasMethod($method)) {
            throw new ProcessorException(sprintf(
                'The "%s" context object method is undefined',
                $method
            ));
        }

        return call_user_func_array(
            array($token->getContext(), $method),
            $token->getOptions()
        );
    }
}
