<?php

namespace Tms\Bundle\MergeTokenBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tms\Bundle\MergeTokenBundle\DependencyInjection\Compiler\TmsMergeTokenTwigEnvironmentPass;

/**
 * Bundle.
 */
class TmsMergeTokenBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new TmsMergeTokenTwigEnvironmentPass());
    }
}