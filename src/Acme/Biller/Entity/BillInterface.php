<?php

namespace Acme\Biller\Entity;

use Doctrine\Common\Collections\ArrayCollection;

// Contracts
use Acme\Biller\Entity\ItemInterface;

interface BillInterface 
{
    /**
     * Set item list
     *
     * @param ArrayCollection $list
     * 
     * @return CartInterface
     */
    public function setItems(ArrayCollection $list);

    /**
     * Get Cart chosen items list
     *
     * @return ArrayCollection<ItemInterface>
     */
    public function getItems();

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function addItem(ItemInterface $item);

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function removeItem(ItemInterface $item);

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * 
     * @return CartInterface
     */
    public function setTimestamp(\DateTime $timestamp);

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp();

    /**
     * Get the sum of each item cost
     *
     * @return number
     */
    public function getSubtotal();

    /**
     * Get the taxed sum
     *
     * @return number
     */
    public function getTaxSum();

    /**
     * Get the sum of tax and cost
     *
     * @return number
     */
    public function getTotal();

    /**
     * Set the sum that has been taxed
     * 
     * @return BillInterface
     */
    public function setTaxSum($sum);

}