<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Tms\Bundle\MergeTokenBundle\Processor\ProcessorHandler;
use Tms\Bundle\MergeTokenBundle\Processor\DummyProcessor;
use Tms\Bundle\MergeTokenBundle\Model\Tag;

class ProcessorHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testSetProcessor()
    {
        $dumyProcessor = new DummyProcessor();
        $handler = new ProcessorHandler();
        $handler->setProcessor('dummy', $dumyProcessor);

        $this->assertEquals($dumyProcessor, $handler->getProcessor('dummy'));
    }
}
