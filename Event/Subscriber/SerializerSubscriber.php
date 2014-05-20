<?php

namespace Tms\Bundle\MergeTokenBundle\Event\Subscriber;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\EventDispatcher\Events;

/**
 * SerializerSubscriber
 *
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */
class SerializerSubscriber implements EventSubscriberInterface
{
    protected $twig;

    /**
     * Constructor
     *
     * @param Twig_Environment $twig
     */
    public function __construct(\Twig_Environment $twig)
    {
        $this->twig = clone $twig;
        $this->twig->setLoader(new \Twig_Loader_String());
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
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
            array(
                'event'     => Events::POST_SERIALIZE,
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'method'    => 'onPostSerialize',
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onPreSerialize(ObjectEvent $event)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onPostSerialize(ObjectEvent $event)
    {
        $context = $event->getContext();
//        var_dump($context->getVisitor()->getNavigator()); die;
        //var_dump($context->attributes->get('groups')); die;
        $context->attributes->get('groups')->map(
            function(array $groups) use ($event) {
                if (in_array('tms_merge_token.merge', $groups)) {
                    $object = $event->getObject();
                    var_dump($object);
                }
            }
        );

        /*
        $type = $event->getType();
        if ($event->getObject() instanceof \Tms\Bundle\OperationBundle\Entity\OfferModality) {
            $modality = $event->getObject();
            $modality->setInformation($this
                ->getTwig()
                ->render(
                    $modality->getInformation(),
                    array('object' => $modality->getOffer())
                )
            );
        }
        */

        var_dump(get_class($event->getVisitor()));die;
        $event->getVisitor()->setData('updatedAt', 'someValue');
    }
}
