<?php

/**
 * @author Gabriel Bondaz <gabriel.bondaz@idci-consulting.fr>
 */

namespace Tms\Bundle\MergeTagBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\DefinitionDecorator;

class MergeTagProcessorCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('tms_merge_tag.processor_handler')) {
            return;
        }

        $definition = $container->getDefinition('tms_merge_tag.processor_handler');
        $processorServices = $container->findTaggedServiceIds('tms_merge_tag.processor');

        foreach ($processorServices as $id => $attributes) {
            $definition->addMethodCall(
                'setProcessor',
                array($attributes[0]['alias'], $id)
            );
        }
    }
}
