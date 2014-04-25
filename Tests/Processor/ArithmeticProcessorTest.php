<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Tms\Bundle\MergeTokenBundle\Processor\ArithmeticProcessor;

class ArithmeticProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testSum()
    {
        $this->assertEquals(4, ArithmeticProcessor::sum(array(1, 2, 1)));
        $this->assertEquals(142, ArithmeticProcessor::sum(array(0, 40, 0, 2, 100)));
    }

    public function testSub()
    {
        $this->assertEquals(42, ArithmeticProcessor::sub(array(50, 8)));
        $this->assertEquals(0, ArithmeticProcessor::sub(array(10, 10)));
    }

    public function testMul()
    {
        $this->assertEquals(64, ArithmeticProcessor::mul(array(8, 8)));
        $this->assertEquals(0, ArithmeticProcessor::mul(array(1234, 0)));
    }

    public function testDiv()
    {
        $this->assertEquals(5, ArithmeticProcessor::div(array(50, 10)));
        $this->assertEquals(1, ArithmeticProcessor::div(array(123, 123)));
    }
}
