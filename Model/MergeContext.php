<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Model;

class MergeContext
{
    protected $name;
    protected $object;

    /**
     * Constructor
     *
     * @param string|null $name
     * @param object|null $object
     */
    public function __construct($name = null, $object = null)
    {
        $this->name   = $name;
        $this->object = $object;
    }

    /**
     * Is Defined
     *
     * @return boolean
     */
    public function isDefined()
    {
        return $this->hasName() || $this->hasObject();
    }

    /**
     * Get Name
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Has Name
     *
     * @return boolean
     */
    public function hasName()
    {
        return null !== $this->name;
    }

    /**
     * Set Name
     *
     * @param  string $name
     * @return MergeContext
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get Object
     *
     * @return object|null
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Has Object
     *
     * @return boolean
     */
    public function hasObject()
    {
        return null !== $this->object;
    }

    /**
     * Set Object
     *
     * @param  object $object
     * @return MergeContext
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }
}
