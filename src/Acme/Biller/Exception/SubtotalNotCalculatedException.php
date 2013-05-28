<?php

/**
 * This file is part of Acme Biller
 *
 * @package AcmeBiller
 */

namespace Acme\Biller\Exception;

class SubtotalNotCalculatedException 
    extends \LogicException 
{
    protected $message = 'Subtotal is not calculated';
}