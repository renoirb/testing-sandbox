<?php

namespace Acme\BillerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // http://symfony.com/doc/2.2/reference/forms/types/money.html
        $costOptions['currency'] = 'CAD';
        
        $builder->add('cost', 'money', $costOptions);

        $builder->add('description', 'text');

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BillerBundle\Entity\Item',
        ));
    }

    public function getName()
    {
        return 'item';
    }
}