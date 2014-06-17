<?php

namespace Tms\Bundle\MergeTokenBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Adds tagged twig.extension services to TmsMergeToken twig service
 */
class TmsMergeTokenTwigEnvironmentPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('tms_merge_token.twig')) {
            return;
        }

        $definition = $container->getDefinition('tms_merge_token.twig');
        $calls = $definition->getMethodCalls();
        $definition->setMethodCalls(array());
        foreach ($container->findTaggedServiceIds('twig.extension') as $id => $attributes) {
            $definition->addMethodCall('addExtension', array(new Reference($id)));
        }
        $definition->setMethodCalls(array_merge($definition->getMethodCalls(), $calls));
    }
}
