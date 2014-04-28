<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Model\Tests;

use Tms\Bundle\MergeTokenBundle\Model\MergeContext;
use Tms\Bundle\MergeTokenBundle\Tests\Fixtures\DummyObject;

class MergeContextTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithoutArguments()
    {
        $mergeContext = new MergeContext();

        $this->assertInstanceOf('Tms\Bundle\MergeTokenBundle\Model\MergeContext', $mergeContext);
        $this->assertNull($mergeContext->getName());
        $this->assertNull($mergeContext->getObject());
        $this->assertFalse($mergeContext->hasName());
        $this->assertFalse($mergeContext->hasObject());
    }

    public function testConstructWithArguments()
    {
        $mergeContext = new MergeContext('Default', new DummyObject());

        $this->assertInstanceOf('Tms\Bundle\MergeTokenBundle\Model\MergeContext', $mergeContext);
        $this->assertEquals('Default', $mergeContext->getName());
        $this->assertInstanceOf('Tms\Bundle\MergeTokenBundle\Tests\Fixtures\DummyObject', $mergeContext->getObject());
        $this->assertTrue($mergeContext->hasName());
        $this->assertTrue($mergeContext->hasObject());
    }

    public function testSetters()
    {
        $mergeContext = new MergeContext();
        $mergeContext
            ->setName('Default')
            ->setObject(new DummyObject())
        ;

        $this->assertInstanceOf('Tms\Bundle\MergeTokenBundle\Model\MergeContext', $mergeContext);
        $this->assertEquals('Default', $mergeContext->getName());
        $this->assertInstanceOf('Tms\Bundle\MergeTokenBundle\Tests\Fixtures\DummyObject', $mergeContext->getObject());
        $this->assertTrue($mergeContext->hasName());
        $this->assertTrue($mergeContext->hasObject());
    }
}
