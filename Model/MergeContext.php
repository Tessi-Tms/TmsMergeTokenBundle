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
     */
    private function __construct()
    {
        $this->name   = null;
        $this->object = null;
    }

    /**
     * Create
     *
     * @param array       $context
     * @param string|null $name
     */
    public static function create(array $context = array(), $name = null)
    {
        $object = new self();

        if (isset($context['object'])) {
            $object->setObject($context['object']);
        }

        if (null !== $name) {
            $object->setName($name);
        }

        return $object;
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
    private function setName($name)
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
    private function setObject($object)
    {
        $this->object = $object;

        return $this;
    }
}
