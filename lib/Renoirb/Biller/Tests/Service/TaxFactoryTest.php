<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Tests\Service;

// Entities
use Renoirb\Biller\Entity\Tax;

// Specific
use Renoirb\Biller\Tests\BillerTestCase;

// Object to test
use Renoirb\Biller\Service\TaxFactory;

/**
 * Test Tax Factory
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class TaxFactoryTest
    extends BillerTestCase
{

    public function setUp()
    {
        $this->taxFactory = new TaxFactory;
    }

    protected static function getTaxFactoryMethod($methodName) {
      $class = new \ReflectionClass('Renoirb\Biller\Service\TaxFactory');
      $method = $class->getMethod($methodName);
      $method->setAccessible(true);

      return $method;
    }

    /**
     * @test
     */
    public function create()
    {
        $expected_rate = 5;
        $tested_name = 'TPS';
        $expected_name = 'tps';

        $tax = $this->taxFactory->create($expected_rate, $tested_name);

        $message1 = 'Creating a tax with a given rate should have the same rate';
        $this->assertEquals($expected_rate, $tax->getRate(), $message1);
    }

    /**
     * @test
     * @depends create
     */
    public function get()
    {
        $tested_name = 'TVQ';

        $tax = $this->taxFactory->create(6,$tested_name);
        $tax2 = $this->taxFactory->get($tested_name);

        $message1 = 'Calling an already created tax would give the same instance';
        $this->assertEquals($tax, $tax2, $message2);
    }

    /**
     * @test
     * @depends get
     */
    public function changeRate()
    {
        $tested_name = 'TPS';
        // see create $expected_rate property
        $expected_previously_set_rate = 5; 

        $tax = $this->taxFactory->get($tested_name);

        $message3 = 'Changing the rate of an instance, should also affect others from the same type';
        $tax2->setRate(4);
        $this->assertEquals($tax->getRate(), $expected_previously_set_rate, $message3);
    }
}