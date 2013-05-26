<?php

namespace Acme\BillerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class AcmeBillerExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
    }

    public function getAlias()
    {
        return 'acme_biller';
    }
}
