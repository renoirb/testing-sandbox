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
use Symfony\Component\HttpFoundation\Request;

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
    public function calculateAction(Request $request)
    {

        $switch = $request->get('u',1);

        $bill = new Bill();

        switch($switch) {
            case 1:
                // Use-case 1
                $book = new Line();
                $book->setCost(12.49);
                $book->setDescription('Book');
                $r[] = $book;

                $music = new Line();
                $music->setCost(14.99);
                $music->setDescription('music CD');
                $music->setTaxable(true);
                $r[] = $music;

                $chocolate = new Line();
                $chocolate->setCost(0.85);
                $chocolate->setDescription('Chocolate bar');
                $r[] = $chocolate;
            break;

            case 2:
                // Use-case 2
                $imported_chocolate = new LineImported();
                $imported_chocolate->setCost(10.00);
                $imported_chocolate->setDescription('Imported box of chocolates');
                $r[] = $imported_chocolate;

                $imported_perfume = new LineImported();
                $imported_perfume->setCost(47.50);
                $imported_perfume->setDescription('Imported box of perfume');
                $imported_perfume->setTaxable(true);
                $r[] = $imported_perfume;
            break; 

            case 3:
                // Use-case 3
                $imported_perfume2 = new LineImported();
                $imported_perfume2->setCost(27.99);
                $imported_perfume2->setDescription('imported bottle of perfume');
                $imported_perfume2->setTaxable(true);
                $r[] = $imported_perfume2;

                $perfume = new Line();
                $perfume->setCost(18.99);
                $perfume->setDescription('bottle of perfume');
                $perfume->setTaxable(true);
                $r[] = $perfume;

                $pills = new Line();
                $pills->setCost(9.75);
                $pills->setDescription('headache pills');
                $r[] = $pills;

                $imported_chocolate2 = new LineImported();
                $imported_chocolate2->setCost(11.25);
                $imported_chocolate2->setDescription('box of imported chocolates');
                $r[] = $imported_chocolate2;
            break;
        }

        foreach($r as $row) {
            $bill->addLine($row);
        }

        TaxModel::apply($bill);

        //
        // Here, we could persist
        // the newly created bill
        //
        //$em = $this->getDoctrine()->getEntityManager();
        //$em->persist($bill);
        //$em->flush();

        return array('entity' => $bill);
    }
}
