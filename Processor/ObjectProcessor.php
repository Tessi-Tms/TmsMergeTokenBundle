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
        if (!$token->getMergeContext()->hasObject()) {
            throw new ProcessorException('Merge Context Object required');
        }

        $method = $token->getField();
        $rc = new \ReflectionClass($token->getMergeContext()->getObject());
        if (!$rc->hasMethod($method)) {
            throw new ProcessorException(sprintf(
                'The "%s" context object method is undefined',
                $method
            ));
        }

        $processedData = call_user_func_array(
            array($token->getMergeContext()->getObject(), $method),
            $token->getOptions()
        );

        if ($processedData instanceof \DateTime) {
            return $processedData->format(\DateTime::W3C);
        }

        return (string)$processedData;
    }
}
