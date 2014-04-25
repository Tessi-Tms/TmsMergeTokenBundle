<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Model\Tests;

use Tms\Bundle\MergeTokenBundle\Model\Token;
use Tms\Bundle\MergeTokenBundle\Exception\TokenException;

class TokenTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructWithoutOptions()
    {
        $token = new Token(array(
            '0'     => '%Type.Field%',
            'type'  => 'Type',
            'field' => 'Field'
        ));

        $this->assertInstanceOf('Tms\Bundle\MergeTokenBundle\Model\Token', $token);
        $this->assertEquals('Type', $token->getType());
        $this->assertEquals('Field', $token->getField());
        $this->assertEquals(array(), $token->getOptions());
    }

    public function testConstructWithOptions()
    {
        $token = new Token(array(
            '0'       => '%Type.Field%',
            'type'    => 'Type',
            'field'   => 'Field',
            'options' => '{"key": "value"}'
        ));

        $this->assertInstanceOf('Tms\Bundle\MergeTokenBundle\Model\Token', $token);
        $this->assertEquals('Type', $token->getType());
        $this->assertEquals('Field', $token->getField());
        $this->assertCount(1, $token->getOptions());
    }

    public function testConstructWithWrongOptions()
    {
        try {
            $token = new Token(array(
                '0'       => '%Type.Field%',
                'type'    => 'Type',
                'field'   => 'Field',
                'options' => '{"key" ... "value"}'
            ));

            $this->fail("TokenException not throw");
        } catch (TokenException $e) {
            $this->assertTrue(true);
        }
    }
}
