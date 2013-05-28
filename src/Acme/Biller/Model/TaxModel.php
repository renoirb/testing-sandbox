<?php

/**
 * This file is part of Acme Biller
 *
 * @package AcmeBiller
 */

namespace Acme\Biller\Model;

// Entities
use Acme\Biller\Entity\BillInterface;
use Acme\Biller\Entity\LineInterface;
use Acme\Biller\Entity\LineImportedInterface;

// Exeptions
use Acme\Biller\Exception\SubtotalNotCalculatedException;

/**
 * Tax Model is about manipulating Lines and calculate taxes
 * 
 * Each line has tax and rates applied to it
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class TaxModel 
{
    const CURRENT_TAX_RATE = 10;
    const CURRENT_IMPORTED_TAX_RATE = 5;

    /**
     * Apply sales Tax
     * 
     * The rounding rules for sales tax are 
     * that for a tax rate of n%, a shelf 
     * price of p contains (np/100 rounded up 
     * to the nearest 0.05) amount of sales tax
     */
    protected static function applyTax(LineInterface $line)
    {
        $tax = 0;

        if($line->isTaxable()){
            $p = $line->getCost();
            $n = self::CURRENT_TAX_RATE;

            $tax = round(($n * $p)/100, 2);

            $line->setSalePrice($tax);
        }

        return $tax;
    }

    protected static function applyImportTax(LineInterface $line)
    {
        $tax = 0;

        if($line instanceof LineImportedInterface){
            $p = ($line->getSalePrice() > 0) ? $line->getSalePrice() : $line->getCost();
            $n = self::CURRENT_IMPORTED_TAX_RATE;

            $tax = round(($n * $p)/100, 2);

            $line->setSalePrice($tax);
        }

        return $tax;
    }

    protected static function applySubtotal(BillInterface $bill)
    {
        $st = 0;

        foreach($bill->getLineList() as $line) {
            $st = $st + $line->getCost();
        }
        $bill->setSubTotal($st);

        return $st;
    }

    /**
     *
     * @throws SubtotalNotCalculatedException When Sub total is not yet calculated
     *
     * @return number
     */
    protected static function applyTotal(BillInterface $bill)
    {
        if($bill->getSubtotal() === 0) {
            throw new SubtotalNotCalculatedException();
        }

        $total = 0;
        $total = $bill->getSubtotal() + $bill->getTaxSum();

        $bill->setTotal($total);

        return $total;
    }

    public static function apply(BillInterface $bill)
    {
        $items = $bill->getLineList();
        $bill_tax_sum = 0;

        self::applySubtotal($bill);

        foreach($items as $item) {
            $bill_tax_sum += self::applyTax($item);
            $bill_tax_sum += self::applyImportTax($item);
        }

        $bill->setTaxSum($bill_tax_sum);

        self::applyTotal($bill);

        return $bill;
    }
}