<?php

namespace Acme\Biller\Entity;

use Doctrine\Common\Collections\ArrayCollection;

// Contracts
use Acme\Biller\Entity\ItemInterface;

interface BillInterface 
{
    /**
     * Constructor
     */
    public function __construct(array $items=NULL);

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

}