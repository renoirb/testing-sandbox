<?php

namespace Acme\BillerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BillerBundle\Form\CartType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

// Forms
use Acme\Biller\Model\TaxModel;

// Entities
use Acme\BillerBundle\Entity\ItemTaxable;
use Acme\BillerBundle\Entity\ItemImported;
use Acme\BillerBundle\Entity\Item;
use Acme\BillerBundle\Entity\Bill;

class DemoController extends Controller
{
    /**
     * @Route("/", name="demo_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/bill/calculate", name="demo_bill_calculate")
     * @Template()
     */
    public function billCalculateAction()
    {
        $cd = new Item();
        $cd->setCost(14.99);
        $cd->setTaxable(true);
        $cd->setDescription('music CD');

        $book = new Item();
        $book->setCost(12.49);
        $book->setDescription('Book');

        $c = new ItemImported();
        $c->setCost(0.85);
        $c->setTaxable(true);
        $c->setDescription('Chocolate bar');

        $bill = new Bill();
        $bill->addItem($cd);
        $bill->addItem($book);
        $bill->addItem($c);

        TaxModel::apply($bill);

        return array('entity' => $bill);
    }
}
