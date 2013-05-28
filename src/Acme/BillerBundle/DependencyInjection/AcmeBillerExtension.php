<?php

/**
 * This file is part of Acme Biller
 *
 * This bundle is meant to bootsrap in a HTTP+HTML 
 * representation of Acme Biller
 *
 * @package AcmeBillerBundle
 */

namespace Acme\BillerBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Defining bundle configuration
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
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
