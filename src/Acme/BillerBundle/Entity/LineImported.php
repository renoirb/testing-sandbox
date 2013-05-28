<?php

/**
 * This file is part of Acme Biller
 *
 * This bundle is meant to bootsrap in a HTTP+HTML 
 * representation of Acme Biller
 *
 * @package AcmeBillerBundle
 */

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Contracts
use Acme\Biller\Entity\LineInterface;
use Acme\Biller\Entity\LineImportedInterface;

/**
 * Imported Item Bill Line
 * 
 * @ORM\Entity
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class LineImported
    extends AbstractLine
    implements 
        LineInterface,
        LineImportedInterface
{
}