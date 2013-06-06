<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Tests\Model;

// Entities
use Renoirb\Biller\Entity\BillInterface;
use Renoirb\Biller\Entity\LineInterface;
use Renoirb\Biller\Entity\LineImportedInterface;

// Specific
use Renoirb\Biller\Entity\Line;
use Renoirb\Biller\Entity\InventoryItem;
use Renoirb\Biller\Entity\Bill;
use Renoirb\Biller\Entity\Tax;

// Model to test
use Renoirb\Biller\Model\Tax as TaxModel;

// Exeptions
use Renoirb\Biller\Exception\SubtotalNotCalculatedException;
use Renoirb\Biller\Exception\SalesTaxNotCalculatedException;

/**
 * Test Tax Model
 *
 * This class will need big refactor, lots of
 * duplicated code.
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class TaxTest
    extends \PHPUnit_Framework_TestCase
{
    const TAX_1_RATE = 5;
    const TAX_2_RATE = 10;

    protected $items;
    protected $taxes;

    public function setUp()
    {
        $this->taxModel = new TaxModel;
    }

    protected static function getTaxModelMethod($methodName) {
      $class = new \ReflectionClass('Renoirb\Biller\Model\Tax');
      $method = $class->getMethod($methodName);
      $method->setAccessible(true);

      return $method;
    }

    /**
     * @test
     */
    public function calculateTaxNotTaxable()
    {
        $message = 'Something costing money, that is not taxable, do not get tax calculated';

        $item = new InventoryItem;
        $item->setCost(5);

        $method = self::getTaxModelMethod('calculateItemTaxes');
        $shouldBeZeo = $method->invokeArgs($this->taxModel, array($item));

        $this->assertEquals(0, $shouldBeZero, $message);
    }

    /**
     * @test
     */
    public function calculateTenPercent()
    {
        $message = 'Something taxable costing 10$, with a 10% tax rate, should get a 1$ taxed.';

        $amt = 10;
        $expected = 1;

        $taxTenPercent = new Tax;
        $taxTenPercent->setRate(10);

        $item = new InventoryItem;
        $item->setCost($amt);
        $item->addTax($taxTenPercent);

        $method = self::getTaxModelMethod('calculateItemTaxes');
        $calculate = $method->invokeArgs($this->taxModel, array($item));

        $this->assertEquals($expected, $calculate, $message);
    }

    /**
     * @test
     */
    public function calculateMultipleTaxes()
    {
        $expected = 0.25;

        $message = 'Something costing 1$ that has two taxes at 20 and 5 percent, non compounded, should have a tax amount of 0.25';

        $taxA = new Tax;
        $taxA->setRate(20);

        $taxB = new Tax;
        $taxB->setRate(5);

        $item = new InventoryItem;
        $item->setCost(1);
        $item->addTax($taxA);
        $item->addTax($taxB);

        $method = self::getTaxModelMethod('calculateItemTaxes');
        $calculate = $method->invokeArgs($this->taxModel, array($item));

        $this->assertEquals($expected, $calculate, $message);
    }

    public function testCalculateSubtotal()
    {
        $message = 'A Bill with 4 items, each costing 1$, should have a sub total 4$';

        $expected = 4;

        $bill = new Bill;

        $item = new Line;
        $item->setSalePrice(1);

        $bill->addLine($item);
        $bill->addLine(clone $item);
        $bill->addLine(clone $item);
        $bill->addLine(clone $item);

        $reflectionOfTax = new \ReflectionClass('Renoirb\Biller\Model\Tax');
        $method = $reflectionOfTax->getMethod('calculateSubtotal');
        $method->setAccessible(true);

        $this->assertEquals($expected, $method->invokeArgs($reflectionOfTax, array($bill)), $message);
    }
}