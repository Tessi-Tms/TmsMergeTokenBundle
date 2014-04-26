<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\Processor;

use Symfony\Component\Routing\Router;
use Tms\Bundle\MergeTokenBundle\Model\Token;

class RouteProcessor extends AbstractProcessor
{
    protected $router;

    /**
     * Constructor
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritdoc}
     */
    public function processToken(Token $token)
    {
        $routeName       = $token->getField();
        $routeParameters = $token->getOptions();

        return $this->router->generate($routeName, $routeParameters, true);
    }
}
