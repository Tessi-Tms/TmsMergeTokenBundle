<?php

namespace Tms\Bundle\MergeTokenBundle\Mergeable;

use Tms\Bundle\MergeTokenBundle\Exception\UndefinedMergeableObjectException;

/**
 * MergeableHandler
 *
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */
class MergeableHandler
{
    protected $mergeableObjects;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->mergeableObjects = array();
    }

    /**
     * SetMergeableObject
     *
     * @param string          $id
     * @param MergeableObject $object
     */
    public function setMergeableObject($id, MergeableObject $object)
    {
        $this->mergeableObjects[$id] = $object;
    }

    /**
     * GetMergeableObjects
     *
     * @return array
     */
    public function getMergeableObjects()
    {
        return $this->mergeableObjects;
    }

    /**
     * GetMergeableObject
     *
     * @param  string $id
     * @return MergeableObject
     * @throw  UndefinedMergeableObjectException
     */
    public function getMergeableObject($id)
    {
        if (!isset($this->mergeableObjects[$id])) {
            throw new UndefinedMergeableObjectException('id', $id);
        }

        return $this->mergeableObjects[$id];
    }

    /**
     * GuessMergeableObject
     *
     * @param  string $className
     * @return MergeableObject
     * @throw  UndefinedMergeableObjectException
     */
    public function guessMergeableObject($className)
    {
        foreach($this->getMergeableObjects() as $mergeableObject) {
            if ($mergeableObject->getClassName() == $className) {
                return $mergeableObject;
            }
        }

        throw new UndefinedMergeableObjectException('className', $className);
    }
}