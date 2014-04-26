<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Tests\Processor;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Tms\Bundle\MergeTokenBundle\Processor\RouteProcessor;
use Tms\Bundle\MergeTokenBundle\Tokenizer;
use Tms\Bundle\MergeTokenBundle\Processor\ProcessorHandler;

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
        $processorHandler = new ProcessorHandler();
        $processorHandler->setProcessor('Route', new RouteProcessor($this->router));
        $tokenizer = new Tokenizer($processorHandler);
        $this->fail('TODO: CREATE A FAKE ROUTE');
        //var_dump($tokenizer->merge($text));die;
    }
}
