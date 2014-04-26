<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests;

use Tms\Bundle\MergeTokenBundle\Tokenizer;

class TokenizerTest extends \PHPUnit_Framework_TestCase
{
    public function testOneSimpleToken()
    {
        $text = "This text contains one token: %type.field%";
        $tokenized = Tokenizer::tokenize($text);
        $this->assertCount(1, $tokenized);
        $this->assertEquals('type', $tokenized[0]["type"]);
        $this->assertEquals('field', $tokenized[0]["field"]);
    }

    public function testOneTokenWithEmptyOptions()
    {
        $text = "This text contains one token with empty options: %type.field.{}%";
        $tokenized = Tokenizer::tokenize($text);
        $this->assertCount(1, $tokenized);
        $this->assertEquals('type', $tokenized[0]["type"]);
        $this->assertEquals('field', $tokenized[0]["field"]);
        $this->assertEquals('{}', $tokenized[0]["options"]);
    }

    public function testOneTokenWithOptions()
    {
        $text = "This text contains one token with options: %type.field.{\"key\":\"value\"}%";
        $tokenized = Tokenizer::tokenize($text);
        $this->assertCount(1, $tokenized);
        $this->assertEquals('type', $tokenized[0]["type"]);
        $this->assertEquals('field', $tokenized[0]["field"]);
        $this->assertEquals('{"key":"value"}', $tokenized[0]["options"]);
    }

    public function testTwoSimpleToken()
    {
        $text = "This text contains two tokens, the first %typeA.fieldA% and the second %typeB.fieldB%";
        $tokenized = Tokenizer::tokenize($text);
        $this->assertCount(2, $tokenized);
        $this->assertEquals('typeA', $tokenized[0]["type"]);
        $this->assertEquals('fieldA', $tokenized[0]["field"]);
        $this->assertEquals('typeB', $tokenized[1]["type"]);
        $this->assertEquals('fieldB', $tokenized[1]["field"]);
    }

    public function testNoToken()
    {
        $text = "This text contains no token";
        $tokenized = Tokenizer::tokenize($text);
        $this->assertCount(0, $tokenized);
    }

    public function testNoValidStringToken()
    {
        $text = "This text contains no %valid% token, %.even% %if it's% %look.% %li..ke%";
        $tokenized = Tokenizer::tokenize($text);
        $this->assertCount(0, $tokenized);
    }

    public function testNoValidMixedToken()
    {
        $text = "This text contains no %valid.0% token, %even0.if% it's %look.like.ok%";
        $tokenized = Tokenizer::tokenize($text);
        $this->assertCount(0, $tokenized);
    }
}
