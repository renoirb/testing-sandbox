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
    public function __construct(array $items=NULL) {

        if(is_array($items)) {
            $this->items = new ArrayCollection($items);
        } else {
            $this->items = new ArrayCollection();
        } 

        return $this;
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
        $this->items->add($item);

        return $this;
    }

    /**
     * {@inheritDoc}
     *
     * Satisfying CartInterface
     */
    public function removeItem(ItemInterface $item)
    {
        $this->items->removeElement($item);

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
     * @ORM\PrePersist
     *
     * This is executed ONLY during an INSERT
     * (called 'persist')
     */
    public function prePersistTimestamp()
    {
        $this->setTimestamp(new \DateTime('NOW'));
    }
}
