<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Entity;

use Doctrine\Common\Collections\ArrayCollection;

// Contracts
use Renoirb\Biller\BillInterface;
use Renoirb\Biller\BillLineInterface;

/**
 * A Bill entry
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class Bill
    implements BillInterface
{

    /**
     * @var boolean
     */
    protected $finalized = false;

    /**
     * @var float
     */
    protected $tax_sum;

    /**
     * @var float
     */
    protected $total;

    /**
     * @var float
     */
    protected $sub_total;

    /**
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @var ArrayCollection<BillLineInterface>
     */
    protected $lines;

    public function __construct() {
        $this->lines = new ArrayCollection();

        return $this;
    }


    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function setLineList(ArrayCollection $list)
    {
        $this->lines = $list;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function getLineList()
    {
        return $this->lines;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function addLine(BillLineInterface $line)
    {
        $this->lines->add($line);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function removeLine(BillLineInterface $line)
    {
        $this->lines->removeElement($line);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function setTaxSum($sum)
    {
        $this->tax_sum = $sum;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function getTaxSum()
    {
        return $this->tax_sum;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function setSubtotal($sub_total)
    {
        $this->sub_total = $sub_total;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function getSubtotal()
    {
        return $this->sub_total;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function isFinalized()
    {
        return $this->finalized;
    }

    /**
     * Things to do when a bill is finished
     */
    public function finalize()
    {
        $this->finalized = true;
        $this->setTimestamp(new \DateTime('NOW'));

        return $this;
    }
}
