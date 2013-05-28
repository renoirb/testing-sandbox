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
 * This class will need big refactor, lots of
 * duplicated code.
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class TaxModelTest
    extends \PHPUnit_Framework_TestCase
{
    public function testCalculateTaxNotTaxable()
    {
        $message = 'Something costing money, that is not taxable, do not get tax calculated';

        $line = new Line;
        $line->setCost(2);

        $reflectionOfTaxModel = new \ReflectionClass('Acme\Biller\Model\TaxModel');
        $method = $reflectionOfTaxModel->getMethod('calculateTax');
        $method->setAccessible(true);

        $this->assertEquals(0, $method->invokeArgs($reflectionOfTaxModel, array($line)),$message);
    }

    public function testCalculateTenPercent()
    {
        $message = 'Something taxable costing 10$, would get a 1$ taxed.';

        $amt = 10;
        $expected = 1;

        $line = new Line;
        $line->setCost($amt);
        $line->setTaxable(true);

        $reflectionOfTaxModel = new \ReflectionClass('Acme\Biller\Model\TaxModel');
        $method = $reflectionOfTaxModel->getMethod('calculateTax');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($reflectionOfTaxModel, array($line)), $message);
    }

    public function testCalculateImportTaxFivePercent()
    {
        $message = 'Something imported, costing 5$, should get taxed $0.25';

        $amt = 5;
        $expected = 0.25;

        $line = new LineImported;
        $line->setCost($amt);

        $reflectionOfTaxModel = new \ReflectionClass('Acme\Biller\Model\TaxModel');
        $method = $reflectionOfTaxModel->getMethod('calculateImportTax');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($reflectionOfTaxModel, array($line)), $message);
    }

    public function testCalculateSubtotal()
    {
        $message = 'A Bill with 4 items, each costing 1$, should have a sub total 4$';

        $amt = 1;
        $expected = 4;

        $bill = new Bill;

        $bill->addLine(new Line($amt,'Test 1'));
        $bill->addLine(new Line($amt,'Test 2'));
        $bill->addLine(new Line($amt,'Test 3'));
        $bill->addLine(new Line($amt,'Test 4'));

        $reflectionOfTaxModel = new \ReflectionClass('Acme\Biller\Model\TaxModel');
        $method = $reflectionOfTaxModel->getMethod('calculateSubtotal');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($reflectionOfTaxModel, array($bill)), $message);
    }

    // Not finished.
}