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

// Contracts
use Acme\Biller\Entity\LineInterface;

/**
 * Bill Line
 * 
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({
 *     "line" = "Line", 
 *     "line_imported" = "LineImported"
 * })
 * 
 * @ORM\Entity
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
abstract class AbstractLine
    implements LineInterface
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
    protected $sale_price = 0;

    /**
     * @var float
     *
     * @ORM\Column(name="cost", type="decimal")
     */
    protected $cost = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    protected $description = NULL;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $taxable = FALSE;

    public function __construct($cost=NULL, $description=NULL, $taxable=FALSE)
    {
        if($cost !== NULL){
            $this->cost = $cost;
        }

        if($description !== NULL){
            $this->description = $description;
        }
        $this->taxable = $taxable;

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
     * Satisfying LineInterface
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * Set the description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function setTaxable($bool)
    {
        // Forcing boolean instead 
        // of typehinting
        $this->taxable = !! $bool;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function isTaxable()
    {
        return $this->taxable;
    }


    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function setSalePrice($price)
    {
        $this->sale_price = $price;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying LineInterface
     */
    public function getSalePrice()
    {
        return $this->sale_price;
    }
}