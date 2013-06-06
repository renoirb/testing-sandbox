<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Exception;

class SalesTaxNotCalculatedException 
    extends \LogicException 
{
    protected $message = 'Sales tax has to be calculated prior to call this method';
}