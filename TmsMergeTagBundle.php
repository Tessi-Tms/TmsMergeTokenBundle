<?php
namespace Tms\Bundle\MergeTagBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Tms\Bundle\MergeTagBundle\DependencyInjection\Compiler\MergeTagProcessorCompilerPass;

class TmsMergeTagBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MergeTagProcessorCompilerPass());
    }
}
