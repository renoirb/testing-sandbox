<?php

namespace Renoirb\Biller\Service;

// Entities
use Renoirb\Biller\Entity\Tax;

/**
 * Tax Factory
 * 
 * To use in a Symfony2 project, see:
 * http://symfony.com/doc/current/components/dependency_injection/factories.html#passing-arguments-to-the-factory-method
 *
 * @author Renoir Boulanger <hello@renoirboulanger.com>
 **/
class TaxFactory 
{
    protected $taxes = array();

    protected function makeSlug($name)
    {
        // mb_ereg_replace do NOT have same pattern format as ereg_replace
        // we do not need to put separators -_-;
        // http://php.net/manual/en/function.mb-ereg-replace.php#101615
        $name = mb_ereg_replace('[\.\s\t ]', '-', mb_strtolower(stripslashes($name), 'UTF-8'));
        return trim($name);
    }

    public function get($name)
    {
        $slug = $this->makeSlug($name);
        
        if(array_key_exists($slug, $this->taxes) === FALSE)
        {
            throw new \RuntimeException("Tax '{$name}' is not registered");
        }

        return $this->taxes[$slug];
    }

    /**
     * Create a tax
     * 
     * @param  integer $rate tax rate
     * @param  string  $name name of the tax
     * 
     * @return TaxInterface
     */
    public function create($rate = 5, $name = 'TPS')
    {
        if(array_key_exists($slug, $this->taxes) === TRUE)
        {
            throw new \RuntimeException("Tax '{$name}' already created, please use get method instead");
        }

        $tax = new Tax($rate, $name);

        $slug = $this->makeSlug($name);
        $this->taxes[$slug] = $tax;

        return $tax;
    }
}