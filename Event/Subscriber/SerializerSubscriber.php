<?php

namespace Tms\Bundle\MergeTokenBundle\Event\Subscriber;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

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
            array('event' => 'serializer.pre_serialize',  'method' => 'onPreSerialize'),
            array('event' => 'serializer.post_serialize', 'method' => 'onPostSerialize'),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function onPreSerialize(ObjectEvent $event)
    {
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
    }

    /**
     * {@inheritdoc}
     */
    public function onPostSerialize(ObjectEvent $event)
    {
    }
}
