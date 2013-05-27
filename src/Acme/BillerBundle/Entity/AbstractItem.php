<?php

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

// Contracts
use Acme\Biller\Entity\ItemInterface;

/**
 * Item
 *
 * An item, that is not taxable
 * 
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discriminator", type="string")
 * @ORM\DiscriminatorMap({
 *     "item" = "Item", 
 *     "imported" = "ItemImported"
 * })
 * 
 * @ORM\Entity
 */
abstract class AbstractItem
    implements ItemInterface
{
    const CURRENT_TAX_RATE = 0.10;

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
     * @ORM\Column(name="cost", type="decimal")
     */
    protected $cost;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    protected $description;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $taxable = FALSE;

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
     * Satisfying ItemInterface
     */
    public function setCost($cost)
    {
        $this->cost = $cost;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying ItemInterface
     */
    public function getCost()
    {
        return $this->cost;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying ItemInterface
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying ItemInterface
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying ItemInterface
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
     * Satisfying ItemInterface
     */
    public function isTaxable()
    {
        return $this->taxable;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying ItemInterface
     */
    public function getTaxRates()
    {
        $rates = array();
        if($this->isTaxable()){
            $rates['sales'] = static::CURRENT_TAX_RATE;
        }

        return $rates;
    }
}