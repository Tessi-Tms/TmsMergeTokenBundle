<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Exception;

class TokenException extends \Exception
{
    /**
     * The constructor
     *
     * @param string $message
     */
    public function __construct($message)
    {
        parent::__construct(sprintf(
            'Token exception: %s',
            $message
        ));
    }
}
