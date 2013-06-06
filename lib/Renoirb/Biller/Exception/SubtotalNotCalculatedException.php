<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Exception;

class SubtotalNotCalculatedException 
    extends \LogicException 
{
    protected $message = 'Subtotal is not calculated';
}