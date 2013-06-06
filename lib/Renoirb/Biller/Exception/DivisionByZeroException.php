<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Exception;

class DivisionByZeroException 
    extends \LogicException 
{
    protected $message = 'Cannot multiply or divide by zero';
}