<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Entity;

// Contract 
use Renoirb\Biller\TaxInterface;

/**
 * A Tax
 * 
 * Can be used as an entity base, or using DiC.
 * 
 * To use in a Bundle, you can extend this class and replicate
 * the properties with proper Doctrine2 annotations.
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
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
     * Set Tax name
     */
    public function setName()
    {
        return $this->name;
    }

    /**
     * Constructor function
     */
    public function __construct($rate = NULL, $name = NULL)
    {
        if($name !== NULL) {
            $this->name = $name;
        }
        if($rate !== NULL) {
            $this->rate = $rate;
        }

        return $this;
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