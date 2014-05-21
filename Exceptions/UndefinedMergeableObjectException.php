<?php

namespace Tms\Bundle\MergeTokenBundle\Exceptions;


/**
 * @author:  Gabriel BONDAZ <gabriel.bondaz@idci-consulting.fr>
 */
class UndefinedMergeableObjectException extends \Exception
{
    /**
     * The constructor
     *
     * @param string $id
     */
    public function __construct($property, $value)
    {
        parent::__construct(sprintf(
            'No mergeable object define with "%s": %s',
            $property,
            $value
        ));
    }
}
