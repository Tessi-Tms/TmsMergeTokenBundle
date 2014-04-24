<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle\Tests\Processor;

use Tms\Bundle\MergeTagBundle\Processor\ProcessorHandler;
use Tms\Bundle\MergeTagBundle\Processor\ValueProcessor;
use Tms\Bundle\MergeTagBundle\Model\Tag;

class ProcessorHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testSetProcessor()
    {
        $dumyProcessor = new ValueProcessor();
        $handler = new ProcessorHandler();
        $handler->setProcessor('dummy', $dumyProcessor);

        $this->assertEquals($dumyProcessor, $handler->getProcessor('dummy'));
    }

    public function testCreateTagWithoutOptions()
    {
        $token = array('type' => 'Type', 'field' => 'Field');
        $tag = ProcessorHandler::createTag($token);
        $this->assertInstanceOf('Tms\Bundle\MergeTagBundle\Model\Tag', $tag);
        $this->assertEquals('Type', $tag->getType());
        $this->assertEquals('Field', $tag->getField());
        $this->assertEquals(array(), $tag->getOptions());
    }

    public function testCreateTagWithOptions()
    {
        $token = array(
            'type'    => 'Type',
            'field'   => 'Field',
            'options' => '{"key": "value"}'
        );
        $tag = ProcessorHandler::createTag($token);
        $this->assertInstanceOf('Tms\Bundle\MergeTagBundle\Model\Tag', $tag);
        $this->assertEquals('Type', $tag->getType());
        $this->assertEquals('Field', $tag->getField());
        $this->assertCount(1, $tag->getOptions());
    }

    public function testCreateTagWithWrongOptions()
    {
        $token = array(
            'type'    => 'Type',
            'field'   => 'Field',
            'options' => '{"key": "value"}'
        );
        try {
            $tag = ProcessorHandler::createTag($token);
            $this->fail("Exception not throw");
        } catch (\Exception $e) {
            $this->assertTrue(true);
        }
    }
}
