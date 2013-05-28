<?php

/**
 * This file is part of Acme Biller
 *
 * @package AcmeBiller
 */

namespace Acme\Biller\Entity;

use Doctrine\Common\Collections\ArrayCollection;

// Contracts
use Acme\Biller\Entity\LineInterface;

/**
 * A bill is an entry describing a sale
 *
 * Each line has tax and rates applied to it
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
interface BillInterface 
{
    /**
     * Set line list
     *
     * @param ArrayCollection $list
     * 
     * @return BillInterface
     */
    public function setLineList(ArrayCollection $list);

    /**
     * Get lines on that particular bill
     * 
     * A line is an item on a Bill
     *
     * @return ArrayCollection<LineInterface>
     */
    public function getLineList();

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function addLine(LineInterface $line);

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function removeLine(LineInterface $line);

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp();

    /**
     * Get the sum of each line cost
     *
     * @return number
     */
    public function getSubtotal();

    /**
     * Set the sub total
     *
     * @return number
     */
    public function setSubtotal($sub_total);

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
     * Set the sum of tax and cost
     *
     * @return number
     */
    public function setTotal($total);

    /**
     * Set the sum that has been taxed
     * 
     * @return BillInterface
     */
    public function setTaxSum($sum);
}