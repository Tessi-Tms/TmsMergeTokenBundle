<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;
use Tms\Bundle\MergeTokenBundle\Exception\TokenException;
use Tms\Bundle\MergeTokenBundle\Exception\ProcessorException;

class ArithmeticProcessor extends AbstractProcessor
{
    /**
     * {@inheritdoc}
     */
    public function processToken(Token $token)
    {
        $operation = $token->getField();

        $rc = new \ReflectionClass($this);
        if (!$rc->hasMethod($operation)) {
            throw new ProcessorException(sprintf(
                'The %s operation is undefined',
                $operation
            ));
        }

        return call_user_func_array(
            array($rc->getName(), $operation),
            array($token->getOption('operands'))
        );
    }

    /**
     * Sum
     *
     * @param array $operands
     */
    public static function sum(array $operands)
    {
        $result = 0;
        foreach ($operands as $operand) {
            $result += $operand;
        }

        return $result;
    }

    /**
     * Sub
     *
     * @param array $operands
     */
    public static function sub(array $operands)
    {
        $result = $operands[0];
        foreach ($operands as $i => $operand) {
            if ($i == 0) {
                continue;
            }
            $result -= $operand;
        }

        return $result;
    }

    /**
     * Mul
     *
     * @param array $operands
     */
    public static function mul(array $operands)
    {
        $result = 1;
        foreach ($operands as $operand) {
            $result *= $operand;
        }

        return $result;
    }

    /**
     * Div
     *
     * @param array $operands
     */
    public static function div(array $operands)
    {
        $result = $operands[0];
        foreach ($operands as $i => $operand) {
            if ($i == 0) {
                continue;
            }
            $result /= $operand;
        }

        return $result;
    }
}
