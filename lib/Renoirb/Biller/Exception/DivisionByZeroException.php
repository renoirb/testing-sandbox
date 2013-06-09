<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Exception;

/**
 * Division by Zero exception
 *
 * Should be thrown when calculating taxes
 * and either the quantity, or the rate has been
 * declared as zero.
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class DivisionByZeroException 
    extends \LogicException 
{
    protected $message = 'Cannot multiply or divide by zero';
}