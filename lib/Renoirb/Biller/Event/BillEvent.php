<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Event;

// Contracts
use Symfony\Component\EventDispatcher\Event;

// Entities
use Renoirb\Biller\BillInterface;

/**
 * A Bill event
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class BillEvent
    extends Event
{
    protected $bill;

    const CREATED = 'biller.bill.created';

    const FINALIZED = 'biller.bill.finalized';

    const TAXES_CALCULATED = 'biller.bill.taxes_calculated';

    const PAID = 'biller.bill.paid';

    const REFUNDED = 'biller.bill.refunded';

    const CANCELLED = 'biller.bill.cancelled';

    public function __construct(BillInterface $bill)
    {
        $this->bill = $bill;
    }

    public function getBill()
    {
        return $this->bill;
    }
}