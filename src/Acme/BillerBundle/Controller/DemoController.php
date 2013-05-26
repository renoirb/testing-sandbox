<?php

namespace Acme\BillerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BillerBundle\Form\CartType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

// Forms
use Acme\BillerBundle\Form\BillType;

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
     * @Route("/bill/create", name="demo_bill_create")
     * @Template()
     */
    public function billCreateAction()
    {
        $cd = new ItemTaxable();
        $cd->setCost(14.99);
        $cd->setDescription('music CD');

        $book = new Item();
        $book->setCost(12.49);
        $book->setDescription('Book');

        $c = new ItemImported();
        $c->setCost(0.85);
        $c->setDescription('Chocolate bar');

        $bill = new Bill(array($cd,$book,$c));
        $bill->addItem($cd);
        $bill->addItem($book);
        $bill->addItem($c);

        $form = $this->createForm(new BillType(), $bill);

        $request = $this->get('request');
        if ('POST' == $request->getMethod()) {
            $form->bindRequest($request);
            if ($form->isValid()) {

            }
        }

        return array('form' => $form->createView());
    }
}
