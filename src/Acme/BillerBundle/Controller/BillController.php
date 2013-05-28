<?php

/**
 * This file is part of Acme Biller
 *
 * This bundle is meant to bootsrap in a HTTP+HTML 
 * representation of Acme Biller
 *
 * @package AcmeBillerBundle
 */

namespace Acme\BillerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\BillerBundle\Form\CartType;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

// Forms
use Acme\Biller\Model\TaxModel;

// Entities
use Acme\BillerBundle\Entity\LineTaxable;
use Acme\BillerBundle\Entity\LineImported;
use Acme\BillerBundle\Entity\Line;
use Acme\BillerBundle\Entity\Bill;

/**
 * Controller managing HTTP requests for Acme Biller
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class BillController extends Controller
{
    /**
     * @Route("/", name="bill_index")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/bill/calculate", name="bill_calculate")
     * @Template()
     */
    public function calculateAction()
    {
        $cd = new Line();
        $cd->setCost(14.99);
        $cd->setTaxable(true);
        $cd->setDescription('music CD');

        $book = new Line();
        $book->setCost(12.49);
        $book->setDescription('Book');

        $c = new Line();
        $c->setCost(0.85);
        $c->setDescription('Chocolate bar');

        $bill = new Bill();
        $bill->addLine($cd);
        $bill->addLine($book);
        $bill->addLine($c);

        TaxModel::apply($bill);

        return array('entity' => $bill);
    }
}
