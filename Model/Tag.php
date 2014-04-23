<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle\Model;

class Tag
{
    protected $type;
    protected $field;
    protected $options;
    protected $value;

    /**
     * Constructor
     *
     * @param string $type
     * @param string $field
     * @param array  $options
     */
    public function __construct($type, $field, $options = array())
    {
        $this->type    = $type;
        $this->field   = $field;
        $this->options = $options;
        $this->value   = null;
    }

    /**
     * Get Type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get Field
     *
     * @return string
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * Get Options
     *
     * @return array | null
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get Value
     *
     * @return string | null
     */
    public function getValue()
    {
        return $this->value;
    }
}
