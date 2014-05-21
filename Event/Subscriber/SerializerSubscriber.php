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
    protected $twig;

    protected $mergeableObjectHandler;

    /**
     * Constructor
     *
     * @param Twig_Environment       $twig
     * @param MergeableObjectHandler $mergeableObjectHandler
     */
    public function __construct(\Twig_Environment $twig, MergeableObjectHandler $mergeableObjectHandler)
    {
        $this->twig = clone $twig;
        $this->twig->setLoader(new \Twig_Loader_String());
        $this->mergeableObjectHandler = $mergeableObjectHandler;
    }

    /**
     * Get Twig
     *
     * @return Twig_Environment
     */
    public function getTwig()
    {
        return $this->twig;
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
                $getter = sprintf('get%s', self::camelize($propertyName));
                $setter = sprintf('set%s', self::camelize($propertyName));
                $rc = new \ReflectionClass($object);
                if ($rc->hasMethod($getter)) {
                    $mergedValue = $this->getTwig()->render(
                        $object->$getter(),
                        array($mergeableObject->getId() => $object)
                    );

                    if ($propertyParameters['mode'] == MergeableObject::BLENDING_MODE_REPLACE) {
                        $object->$setter($mergedValue);
                    }

                    if ($propertyParameters['mode'] == MergeableObject::BLENDING_MODE_ADD) {
                        $event->getVisitor()->addData(
                            lcfirst(self::camelize(sprintf('%s_%s_%s',
                                'merged',
                                $mergeableObject->getId(),
                                $propertyName
                            ))),
                            $mergedValue
                        );
                    }
                }
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
