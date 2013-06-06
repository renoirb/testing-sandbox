<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Exception;

class BillFinalizedException
    extends \LogicException
{
    protected $message = 'Cannot modify a finalized bill';
}