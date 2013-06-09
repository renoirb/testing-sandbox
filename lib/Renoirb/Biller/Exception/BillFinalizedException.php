<?php

/**
 * This file is part of Renoirb Biller
 *
 * @package RenoirbBiller
 */

namespace Renoirb\Biller\Exception;

/**
 * Bill is Finalized Exception
 *
 * Should be thrown when a modification is attempted
 * on a bill and has been declared as finalized.
 * 
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 */
class BillFinalizedException
    extends \LogicException
{
    protected $message = 'Cannot modify a finalized bill';
}