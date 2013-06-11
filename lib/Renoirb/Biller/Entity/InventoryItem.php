<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Entity;

// Entities
use Renoirb\Biller\Entity\Line;

// Contracts
use Renoirb\Biller\InventoryItemInterface;
use Renoirb\Biller\TaxInterface;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * An inventory item
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class InventoryItem
    implements InventoryItemInterface
{

    /**
     * Item name
     * 
     * @var string
     */
    protected $name;

    /**
     * Item description
     * 
     * @var string
     */
    protected $description;

    /**
     * Item cost
     * 
     * @var float
     */
    protected $cost;

    /**
     * Quantity
     * 
     * @var integer
     */
    protected $qty;

    /**
     * @var ArrayCollection<TaxInterface>
     */
    protected $taxes;

    public function __construct() {
        $this->taxes = new ArrayCollection();

        return $this;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function setTaxList(ArrayCollection $list)
    {
        return $this;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function getTaxList()
    {
        return $this->taxes;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function addTax(TaxInterface $tax)
    {
        return $this->taxes->add($tax);
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function removeTax(TaxInterface $tax)
    {
        return $this->taxes->removeElement($tax);
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function getQuantity()
    {
        return $this->qty;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function setQuantity($qty)
    {
        $this->qty = $qty;

        return $this;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * {@inheritDoc}
     * 
     * Satisfies InventoryItemInterface
     */
    public function setCost($cost)
    {
        $this->cost = $cost;

        return $this;
    }
}