<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Tms\Bundle\MergeTokenBundle\Tokenizer;
use Tms\Bundle\MergeTokenBundle\Handler\TokenHandler;
use Tms\Bundle\MergeTokenBundle\Processor\DateTimeProcessor;

class DateTimeProcessorTest extends \PHPUnit_Framework_TestCase
{
    public function testMerge()
    {
        $tokenHandler = new TokenHandler();
        $tokenHandler->setProcessor('DateTime', new DateTimeProcessor());

        $date = new \DateTime();
        $text = "%DateTime.now%";
        $this->assertEquals($date->format(\DateTime::W3C), $tokenHandler->merge($text));

        $date = new \DateTime();
        $text = "%DateTime.now.{\"format\":\"Y-m-d\"}%";
        $this->assertEquals($date->format("Y-m-d"), $tokenHandler->merge($text));

        $date = new \DateTime();
        $date->modify('+1 month');
        $text = "%DateTime.modify.{\"modify\":\"+1 month\"}%";
        $this->assertEquals($date->format(\DateTime::W3C), $tokenHandler->merge($text));

        $text = "%DateTime.modify.{\"date\": \"1999-12-31\", \"modify\":\"+1 day\", \"format\":\"Y-m-d\"}%";
        $this->assertEquals('2000-01-01', $tokenHandler->merge($text));
    }
}
