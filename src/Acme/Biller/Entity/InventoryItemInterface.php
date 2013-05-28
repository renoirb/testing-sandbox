<?php

/**
 * This file is part of Acme Biller
 *
 * @package AcmeBiller
 */

namespace Acme\Biller\Entity;

/**
 * An inventory item
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
interface InventoryItemInterface
{
    public function getName();

    public function getDescription();

    public function getCost();
}