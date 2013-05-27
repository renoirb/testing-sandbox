<?php

namespace Acme\Biller\Model;

// Entities
use Acme\Biller\Entity\BillInterface;

class TaxModel {
    public static function apply(BillInterface $bill)
    {
        $items = $bill->getItems();
        $bill_tax_sum = 0;

        foreach($items as $item) {
            $cost = $item->getCost();
            $tax_sum = 0;
            $tax = 0;

            $rates = $item->getTaxRates();

            foreach($rates as $r) {
                // No multiplication 
                // by 0 por favo.
                if($r > 0) {
                    // The rounding rules for sales tax are 
                    // that for a tax rate of n%, a shelf 
                    // price of p contains (np/100 rounded up 
                    // to the nearest 0.05) amount of sales tax
                    $tax = round($cost*$r,2);
                    $tax_sum += $tax;
                }
            }
            $item->setCost($cost+$tax);

            $bill_tax_sum += $tax_sum;
        }

        $bill->setTaxSum($bill_tax_sum);

        return $bill;
    }
}