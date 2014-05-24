<?php

namespace Tms\Bundle\MergeTokenBundle\Event\Subscriber;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\EventDispatcher\Events;
use Tms\Bundle\MergeTokenBundle\Mergeable\MergeableObjectHandler;
use Tms\Bundle\MergeTokenBundle\Mergeable\MergeableObject;
use Tms\Bundle\MergeTokenBundle\Exceptions\UndefinedMergeableObjectException;

/**
 * SerializerSubscriber
 *
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */
class SerializerSubscriber implements EventSubscriberInterface
{
    protected $mergeableObjectHandler;

    /**
     * Constructor
     *
     * @param MergeableObjectHandler $mergeableObjectHandler
     */
    public function __construct(MergeableObjectHandler $mergeableObjectHandler)
    {
        $this->mergeableObjectHandler = $mergeableObjectHandler;
    }

    /**
     * Get Mergeable Object Handler
     *
     * @return MergeableObjectHandler
     */
    public function getMergeableObjectHandler()
    {
        return $this->mergeableObjectHandler;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            array(
                'event'     => Events::PRE_SERIALIZE,
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method'    => 'onPreSerialize',
            ),
//            array(
//                'event'     => Events::POST_SERIALIZE,
//                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
//                'method'    => 'onPostSerialize',
//            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onPreSerialize(ObjectEvent $event)
    {
        $object = $event->getObject();
        $type   = $event->getType();

        try {
            $mergeableObject = $this
                ->getMergeableObjectHandler()
                ->guessMergeableObject($type['name'])
            ;
            foreach ($mergeableObject->getProperties() as $propertyName => $propertyParameters) {
                $this
                    ->getMergeableObjectHandler()
                    ->mergeToken($object, $propertyName)
                ;
            }
        } catch (UndefinedMergeableObjectException $e) {
            return;
        }
    }

    /**
     * {@inheritdoc}
     */
//    public function onPostSerialize(ObjectEvent $event)
//    {
//    }
}
