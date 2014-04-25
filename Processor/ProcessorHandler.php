<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Tms\Bundle\MergeTokenBundle\Model\Token;

class ProcessorHandler extends AbstractProcessor
{
    protected $processors;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->processors = array();
    }

    /**
     * Add processor
     *
     * @param string             $type
     * @param AbstractProcessor  $processor
     */
    public function setProcessor($type, ProcessorInterface $processor)
    {
        $this->processors[$type] = $processor;
    }

    /**
     * Get the right Processor associated with the given type
     *
     * @param  $type
     * @return AbstractProcessor
     */
    public function getProcessor($type)
    {
        if (!isset($this->processors[$type])) {
            throw new \Exception('Undefined processor');
        }

        return $this->processors[$type];
    }

    /**
     * {@inheritdoc}
     */
    public function processToken(Token & $Token)
    {
        return $this->getProcessor($Token->getType())->processToken(Token & $Token);
    }
}
