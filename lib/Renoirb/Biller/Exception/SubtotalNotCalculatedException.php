<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Exception;

/**
 * Subtotal not calculated exception
 *
 * Should be thrown when the subtotal has been requested
 * and it is not been calculated.
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class SubtotalNotCalculatedException 
    extends \LogicException 
{
    protected $message = 'Subtotal is not calculated';
}