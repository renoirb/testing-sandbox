<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Entity;

// Contract 
use Renoirb\Biller\TaxInterface;

class Tax
    implements TaxInterface
{
    /**
     * Apply it on top of the previous 
     * sales taxes or only on the cost
     * 
     * @var boolean
     */
    protected $compound = false;

    /**
     * Rate to apply, integer representing
     * a percent rate;
     * 
     * @var integer
     */
    protected $rate;

    public function setRate($rate)
    {
        $this->rate = $rate;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfies TaxInterface
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfies TaxInterface
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfies TaxInterface
     */
    public function isCompound()
    {
        return $this->compound;
    }
}