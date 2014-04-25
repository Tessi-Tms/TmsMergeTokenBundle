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
    protected $value;

    /**
     * Constructor
     *
     * @param array $raw
     */
    public function __construct($raw)
    {
        $this->raw = $raw;

        if (!isset($raw['type'])) {
            throw new TokenException('Missing raw type');
        }

        if (!isset($raw['field'])) {
            throw new TokenException('Missing raw field');
        }

        $options = array();
        if (isset($raw['options'])) {
            $options = json_decode($raw['options'], true);
            if (null === $options) {
                throw new TokenException('Wrong raw options');
            }
        }

        $this->type    = $raw['type'];
        $this->field   = $raw['field'];
        $this->options = $options;
        $this->value   = null;
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
