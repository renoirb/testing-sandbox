<?php

namespace Acme\Biller\Exception;

class SalesTaxNotCalculatedException 
    extends \LogicException 
{
    protected $message = 'Sales tax has to be calculated prior to call this method';
}