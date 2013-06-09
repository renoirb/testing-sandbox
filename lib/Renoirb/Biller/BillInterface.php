<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller;

// Contracts
use Doctrine\Common\Collections\ArrayCollection;
use Renoirb\Biller\LineInterface;

/**
 * A bill is an entry describing a sale
 *
 * Each LineInterface (line) has a sale price, that is calculated
 * from his originating InventoryInterface (item) own cost value.
 *
 * Each item should know what are the applicable taxes to itself.
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
     * Add a line in the current bill
     *
     * @return BillInterface
     */
    public function addLine(LineInterface $line);

    /**
     * Remove a line in the current bill
     *
     * @return BillInterface
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
     * @return BillInterface
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
     * @return BillInterface
     */
    public function setTotal($total);

    /**
     * Set the sum that has been taxed
     * 
     * @return BillInterface
     */
    public function setTaxSum($sum);

    /**
     * Check if bill has been finalized
     *
     * @return boolean
     */
    public function isFinalized();

    /**
     * Confirm the bill is finished
     * 
     * @return BillInterface
     */
    public function finalize();
}