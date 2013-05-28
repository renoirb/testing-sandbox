<?php

/**
 * This file is part of Acme Biller
 *
 * This bundle is meant to bootsrap in a HTTP+HTML 
 * representation of Acme Biller
 *
 * @package AcmeBillerBundle
 */

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

// Contracts
use Acme\Biller\Entity\BillInterface;
use Acme\Biller\Entity\LineInterface;

/**
 * A Bill entry
 *
 * @ORM\Table()
 * @ORM\Entity
 * 
 * @ORM\HasLifecycleCallbacks
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class Bill
    implements BillInterface
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $tax_sum;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $total;

    /**
     * @var float
     *
     * @ORM\Column(type="decimal")
     */
    protected $sub_total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime")
     */
    protected $timestamp;

    /**
     * @var ArrayCollection<Line>
     *
     * @ORM\ManyToMany(targetEntity="\Acme\BillableBundle\AbstractLine")
     * @ORM\JoinTable(name="cart_line",
     *      joinColumns={@ORM\JoinColumn(name="cart_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="line_id", referencedColumnName="id")}
     * )
     */
    protected $lines;

    public function __construct() {
        $this->lines = new ArrayCollection();

        return $this;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
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
    public function addLine(LineInterface $line)
    {
        $this->lines->add($line);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying BillInterface
     */
    public function removeLine(LineInterface $line)
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
     * @ORM\PrePersist
     *
     * This is executed ONLY during an INSERT
     */
    public function prePersistTimestamp()
    {
        $this->setTimestamp(new \DateTime('NOW'));
    }
}
