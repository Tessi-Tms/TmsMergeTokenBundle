<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Tms\Bundle\MergeTokenBundle\Handler\TokenHandler;
use Tms\Bundle\MergeTokenBundle\Processor\DefaultProcessor;

class TokenHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testSetProcessor()
    {
        $defaultProcessor = new DefaultProcessor();
        $handler = new TokenHandler();
        $handler->setProcessor('Default', $defaultProcessor);

        $this->assertEquals($defaultProcessor, $handler->getProcessor('Default'));
    }

    public function testEmptyMerge()
    {
        $text = "This is a dummy text";
        $handler = new TokenHandler();

        $this->assertEquals($text, $handler->merge($text));
    }

    public function testDefaultMerge()
    {
        $text = "Default %Default.value%";
        $handler = new TokenHandler();
        $handler->setProcessor('Default', new DefaultProcessor());

        $this->assertEquals("Default value", $handler->merge($text));
    }
}
