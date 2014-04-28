<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Tms\Bundle\MergeTokenBundle\Handler\TokenHandler;
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

    public function testMerge()
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->setProcessor('Arithmetic', new ArithmeticProcessor());

        $text = "2 + 2 = %Arithmetic.sum.{\"operands\":[2,2]}%";
        $this->assertEquals("2 + 2 = 4", $tokenHandler->merge($text));

        $text = "2 - 2 = %Arithmetic.sub.{\"operands\":[2,2]}%";
        $this->assertEquals("2 - 2 = 0", $tokenHandler->merge($text));

        $text = "2 * 2 = %Arithmetic.mul.{\"operands\":[2,2]}%";
        $this->assertEquals("2 * 2 = 4", $tokenHandler->merge($text));

        $text = "2 / 2 = %Arithmetic.div.{\"operands\":[2,2]}%";
        $this->assertEquals("2 / 2 = 1", $tokenHandler->merge($text));
    }

    public function testComplexMerge()
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->setProcessor('Arithmetic', new ArithmeticProcessor());

        $text = "2 + (4 + 2) = %Arithmetic.sum.{\"operands\":[2, \"%Arithmetic.sum.{\"operands\":[4,2]}%\"]}%";
        $this->assertEquals("2 + (4 + 2) = 8", $tokenHandler->merge($text));

        $text = "2 + (4 - 2) = %Arithmetic.sum.{\"operands\":[2, \"%Arithmetic.sub.{\"operands\":[4,2]}%\"]}%";
        $this->assertEquals("2 + (4 - 2) = 4", $tokenHandler->merge($text));

        $text = "2 + (4 * 2) = %Arithmetic.sum.{\"operands\":[2, \"%Arithmetic.mul.{\"operands\":[4,2]}%\"]}%";
        $this->assertEquals("2 + (4 * 2) = 10", $tokenHandler->merge($text));

        $text = "2 + (4 / 2) = %Arithmetic.sum.{\"operands\":[2, \"%Arithmetic.div.{\"operands\":[4,2]}%\"]}%";
        $this->assertEquals("2 + (4 / 2) = 4", $tokenHandler->merge($text));
    }
}
