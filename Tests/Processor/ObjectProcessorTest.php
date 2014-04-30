<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Tms\Bundle\MergeTokenBundle\Handler\TokenHandler;
use Tms\Bundle\MergeTokenBundle\Processor\ObjectProcessor;
use Tms\Bundle\MergeTokenBundle\Tests\Fixtures\DummyObject;
use Tms\Bundle\MergeTokenBundle\Exception\ProcessorException;

class ObjectProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testProcess()
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->setProcessor('Object', new ObjectProcessor());

        $context = array('object' => new DummyObject(42));
        $text = "%Object.getId%";
        $this->assertEquals(42, $tokenHandler->merge($text, $context));

        $text = "%Object.getUnknown%";
        try {
            $tokenHandler->merge($text, $context);
            $this->fail('ProcessorException must be thrown');
        } catch (ProcessorException $e) {
            $this->assertEquals(
                "Processor exception: The \"getUnknown\" context object method is undefined",
                $e->getMessage()
            );
        }
    }
}
