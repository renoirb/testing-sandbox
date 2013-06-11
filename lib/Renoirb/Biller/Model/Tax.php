<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Model;

// Entities
use Renoirb\Biller\BillInterface;
use Renoirb\Biller\InventoryItemInterface;
use Renoirb\Biller\TaxInterface;

// Exeptions
use Renoirb\Biller\Exception\SubtotalNotCalculatedException;
use Renoirb\Biller\Exception\DivisionByZeroException;

/**
 * Tax Model
 * 
 * Manipulations made on a Bill to calculate
 * taxes applicable on each Line.
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class Tax
{
    /**
     * Apply Taxes
     * 
     * The rounding rules for sales tax are 
     * that for a tax rate of n%, a shelf 
     * price of p contains (np/100 rounded up 
     * to the nearest 0.05) amount of sales tax
     *
     * n% => rate
     * n  => quantity
     * p  => product cost
     *
     * @throws DivisionByZeroException If either $cost, or $rate equals zero
     */
    protected static function calculateCostAndRate($cost, $rate, $qty = 1)
    {
        if($cost === 0 || $rate === 0)
        {
            throw new DivisionByZeroException;
        }

        // Handling quantities
        $cost = ($qty > 1)? $cost * (int) $qty: $cost;

        return round($cost * $rate/100, 2);
    }

    protected static function calculateItemTaxes(InventoryItemInterface $item, $qty = 1)
    {
        $tax_sum = 0;
        $cost = $item->getCost();

        foreach($item->getTaxList() as $tax)
        {
            $rate = $tax->getRate();
            $tax_sum += self::calculateCostAndRate($cost, $rate, $qty);
        }

        return $tax_sum;
    }

    protected static function calculateSubtotal(BillInterface $bill)
    {
        $st = 0;

        foreach($bill->getLineList() as $line) {
            $st += $line->getSalePrice();
        }

        return $st;
    }

    /**
     *
     * @throws SubtotalNotCalculatedException When Sub total is not yet calculated
     *
     * @return number
     */
    protected static function calculateTotal(BillInterface $bill)
    {
        if($bill->getSubtotal() === 0) {
            throw new SubtotalNotCalculatedException();
        }

        $total = 0;
        $total = $bill->getSubtotal() + $bill->getTaxSum();

        return $total;
    }

    /* NEEDS REWORK
    public static function apply(BillInterface $bill)
    {
        $lines = $bill->getLineList();
        $bill_tax_sum = 0;

        $bill->setSubTotal(self::calculateSubtotal($bill));

        foreach($lines as $line) {
            
            $sales_tax = self::calculateItemTaxes($line);

            $line_tax_sum = $import_tax + $sales_tax;
            $bill_tax_sum += $line_tax_sum;

            $c = $line->getCost();
            $line->setSalePrice($line_tax_sum + $c);
        }

        $bill->setTaxSum($bill_tax_sum);

        $bill->setTotal(self::calculateTotal($bill));

        return $bill;
    }
    */
}