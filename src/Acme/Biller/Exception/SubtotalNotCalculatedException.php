<?php

namespace Acme\Biller\Exception;

class SubtotalNotCalculatedException 
    extends \LogicException 
{
    protected $message = 'Subtotal is not calculated';
}