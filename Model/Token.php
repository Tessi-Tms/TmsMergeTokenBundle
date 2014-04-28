<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Model;

use Tms\Bundle\MergeTokenBundle\Exception\TokenException;

class Token
{
    protected $raw;
    protected $type;
    protected $field;
    protected $options;
    protected $context;
    protected $value;

    /**
     * Constructor
     *
     * @param string       $raw
     * @param string       $type
     * @param string       $field
     * @param array        $options
     * @param MergeContext $mergeContext
     */
    public function __construct($raw, $type, $field, array $options = array(), MergeContext $mergeContext = null)
    {
        $this->raw          = $raw;
        $this->type         = $type;
        $this->field        = $field;
        $this->options      = $options;
        $this->mergeContext = $mergeContext;
        $this->value        = null;
    }

    /**
     * Get Raw
     *
     * @return string
     */
    public function getRaw()
    {
        return $this->raw;
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
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Get Option
     *
     * @param  string     $key
     * @param  mixed|null $default The default value to return if the key is not found
     * @return mixed
     */
    public function getOption($key, $default = null)
    {
        if (!isset($this->options[$key])) {
            if (null === $default) {
                throw new TokenException(sprintf(
                    'Undefined option %s',
                    $key
                ));
            }
            return $default;
        }

        return $this->options[$key];
    }

    /**
     * Get MergeContext
     *
     * @return MergeContext | null
     */
    public function getMergeContext()
    {
        return $this->mergeContext;
    }

    /**
     * Has Merge Context
     *
     * @return boolean
     */
    public function hasMergeContext()
    {
        return $this->getMergeContext()->isDefined();
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

    /**
     * Set Value
     *
     * @param  mixed $value
     * @return Token
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }
}
