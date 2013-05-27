<?php

namespace Acme\BillerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

// Contracts
use Acme\Biller\Entity\BillInterface;
use Acme\Biller\Entity\ItemInterface;

/**
 * Bill
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
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
     * @var ArrayCollection<Item>
     *
     * @ORM\ManyToMany(targetEntity="\Acme\BillableBundle\Item")
     * @ORM\JoinTable(name="cart_item",
     *      joinColumns={@ORM\JoinColumn(name="cart_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="item_id", referencedColumnName="id")}
     * )
     */
    protected $items;

    public function __construct() {
        $this->items = new ArrayCollection();

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
     * Satisfying CartInterface
     */
    public function setItems(ArrayCollection $list)
    {
        $this->items = $list;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function addItem(ItemInterface $item)
    {
        $this->getItems()->add($item);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function removeItem(ItemInterface $item)
    {
        $this->getItems()->removeElement($item);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function setTimestamp(\DateTime $timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function getTotal()
    {
        if($this->total === NULL) {
            $total = $this->getSubtotal() + $this->getTaxSum();
            $this->total = $total;            
        }

        return $this->total;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function setTaxSum($sum)
    {
        $this->tax_sum = $sum;

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function getTaxSum()
    {
        return $this->tax_sum;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function getSubtotal()
    {
        if($this->sub_total === NULL) {
            $st = 0;
            foreach($this->items as $item) {
                $st = $st + $item->getCost();
            }
            $this->sub_total = $st;            
        }

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
