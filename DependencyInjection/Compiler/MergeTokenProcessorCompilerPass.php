<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTokenBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

class MergeTokenProcessorCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('tms_merge_token.processor_handler')) {
            return;
        }

        $definition = $container->getDefinition('tms_merge_token.processor_handler');
        $processorServices = $container->findTaggedServiceIds('tms_merge_token.processor');

        foreach ($processorServices as $id => $attributes) {
            $definition->addMethodCall(
                'setProcessor',
                array($attributes[0]['alias'], $id)
            );
        }
    }
}
