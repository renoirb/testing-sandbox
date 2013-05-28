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
use Acme\Biller\Exception\SalesTaxNotCalculatedException;

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
    protected static function calculateTax(LineInterface $line)
    {
        $tax = 0;

        if($line->isTaxable()){
            $p = $line->getCost();
            $n = self::CURRENT_TAX_RATE;

            $tax = round($n * $p/100, 2);
        }

        return $tax;
    }

    /**
     * Apply Import taxes
     *
     * @param  LineInterface $line Line to calculate import tax on
     * 
     * @return number
     */
    protected static function calculateImportTax(LineInterface $line)
    {
        $tax = 0;

        if($line instanceof LineImportedInterface){
            $p = $line->getCost();
            $n = self::CURRENT_IMPORTED_TAX_RATE;

            $tax = round($n * $p/100, 2);
        }

        return $tax;
    }

    protected static function calculateSubtotal(BillInterface $bill)
    {
        $st = 0;

        foreach($bill->getLineList() as $line) {
            $st += $line->getCost();
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

    public static function apply(BillInterface $bill)
    {
        $lines = $bill->getLineList();
        $bill_tax_sum = 0;

        $bill->setSubTotal(self::calculateSubtotal($bill));

        foreach($lines as $line) {
            $c = $line->getCost();
            
            $sales_tax = self::calculateTax($line);

            $import_tax = self::calculateImportTax($line);

            $line_tax_sum = $import_tax + $sales_tax;
            $bill_tax_sum += $line_tax_sum;

            $line->setSalePrice($line_tax_sum + $c);
        }

        $bill->setTaxSum($bill_tax_sum);

        $bill->setTotal(self::calculateTotal($bill));

        return $bill;
    }
}