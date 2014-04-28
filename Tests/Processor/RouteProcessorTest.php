<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tms\Bundle\MergeTokenBundle\Handler\TokenHandler;
use Tms\Bundle\MergeTokenBundle\Processor\RouteProcessor;

class RouteProcessorTest extends WebTestCase
{
    /**
     * @var \Symfony\Component\Routing\Router
     */
    private $router;

    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->router = static::$kernel->getContainer()->get('router');
    }

    public function testProcess()
    {
        $text = "Go to %Route._tms_merge_token_test_route%";
        $tokenHandler = new TokenHandler();
        $tokenHandler->setProcessor('Route', new RouteProcessor($this->router));
        $this->fail('TODO: CREATE A FAKE ROUTE');
        //var_dump($tokenizer->merge($text));die;
    }
}
