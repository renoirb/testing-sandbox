<?php

namespace spec\Renoirb\Biller\Model;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TaxSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Renoirb\Biller\Model\Tax');
    }
}