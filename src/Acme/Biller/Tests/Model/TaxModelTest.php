<?php

/**
 * This file is part of Acme Biller
 *
 * @package AcmeBiller
 */

namespace Acme\Biller\Tests\Model;

// Entities
use Acme\Biller\Entity\BillInterface;
use Acme\Biller\Entity\LineInterface;
use Acme\Biller\Entity\LineImportedInterface;

// Specific
use Acme\Biller\Model\TaxModel;

// Should be in a separate file, or minimal implementation
use Acme\BillerBundle\Entity\Line;
use Acme\BillerBundle\Entity\LineImported;
use Acme\BillerBundle\Entity\Bill;

// Exeptions
use Acme\Biller\Exception\SubtotalNotCalculatedException;
use Acme\Biller\Exception\SalesTaxNotCalculatedException;

/**
 * Test Tax Model
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class TaxModelTest
    extends \PHPUnit_Framework_TestCase
{
    public function testCalculateTaxNotTaxable()
    {
        $line = new Line;
        $line->setCost(2);

        $reflectionOfTaxModel = new \ReflectionClass('Acme\Biller\Model\TaxModel');
        $method = $reflectionOfTaxModel->getMethod('calculateTax');
        $method->setAccessible(true);

        $this->assertEquals(0, $method->invokeArgs($reflectionOfTaxModel, array($line)));     
    }

    public function testCalculateTax()
    {
        $line = new Line;
        $line->setCost(1);

        $reflectionOfTaxModel = new \ReflectionClass('Acme\Biller\Model\TaxModel');
        $method = $reflectionOfTaxModel->getMethod('calculateTax');
        $method->setAccessible(true);

        $this->assertEquals(0, $method->invokeArgs($reflectionOfTaxModel, array($line)));     
    }
}