<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle\Tests\Processor;

use Tms\Bundle\MergeTagBundle\Processor\ProcessorHandler;
use Tms\Bundle\MergeTagBundle\Processor\ValueProcessor;

class ProcessorHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testSetProcessor()
    {
        $dumyProcessor = new ValueProcessor();
        $handler = new ProcessorHandler();
        $handler->setProcessor('dummy', $dumyProcessor);

        $this->assertEquals($dumyProcessor, $handler->getProcessor('dummy'));
    }
}
