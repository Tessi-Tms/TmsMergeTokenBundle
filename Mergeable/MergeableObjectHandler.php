<?php

namespace Tms\Bundle\MergeTokenBundle\Mergeable;

use Symfony\Component\DependencyInjection\Container;
use Tms\Bundle\MergeTokenBundle\Exceptions\UndefinedMergeableObjectException;
use Tms\Bundle\MergeTokenBundle\Exceptions\MissingMergeableObjectMethodException;

/**
 * MergeableObjectHandler
 *
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */
class MergeableObjectHandler
{
    protected $container;
    protected $mergeableObjects;

    /**
     * Constructor
     *
     * @param Container $tmsMergeTokenTwig
     * @param array     $data
     */
    public function __construct(Container $container, array $data)
    {
        $this->container = $container;

        foreach ($data as $id => $mergeableObjectRaw) {
            $this->setMergeableObject($id, new MergeableObject(
                $id,
                $mergeableObjectRaw['class'],
                $mergeableObjectRaw['properties']
            ));
        }
    }

    /**
     * Get container
     *
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Get Tms merge token twig
     *
     * @return Twig_Environment
     */
    public function getTmsMergeTokenTwig()
    {
        return $this->getContainer()->get('tms_merge_token.twig');
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

    /**
     * Merge token
     *
     * @param  object  $object
     * @param  string  $propertyName
     * @param  boolean $replace
     * @return string  The merge value
     */
    public function mergeToken($object, $propertyName, $replace = true)
    {
        $rc = new \ReflectionClass($object);

        $mergeableObject = $this->guessMergeableObject($rc->getName());

        $getter = sprintf('get%s', self::camelize($propertyName));
        $setter = sprintf('set%s', self::camelize($propertyName));
        if (!$rc->hasMethod($getter)) {
            throw new MissingMergeableObjectMethodException($object, $getter);
        }
        if (!$rc->hasMethod($setter)) {
            throw new MissingMergeableObjectMethodException($object, $setter);
        }

        $mergedValue = $this->getTmsMergeTokenTwig()->render(
            $object->$getter(),
            array($mergeableObject->getId() => $object)
        );

        if ($replace) {
            $object->$setter($mergedValue);
        }

        return $mergedValue;
    }

    /**
     * Returns given word as CamelCased
     *
     * Converts a word like "send_email" to "SendEmail". It
     * will remove non alphanumeric character from the word, so
     * "who's online" will be converted to "WhoSOnline"
     *
     * @param  string $word
     * @return string UpperCamelCasedWord
     */
    public static function camelize($word)
    {
        return str_replace(' ', '' , ucwords(
            preg_replace('/[^A-Z^a-z^0-9]+/', ' ', $word)
        ));
    }
}
