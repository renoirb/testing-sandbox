<?php

namespace Acme\BillerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Acme\BillerBundle\Form\ItemType;

class BillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $itemsConfig['type'] = new ItemType();
        $itemsConfig['allow_add'] = true;
        $itemsConfig['allow_delete'] = true;
        $itemsConfig['prototype_name'] = '__ITEM_PROTO__';

        $itemsConfig['options']['required'] = false;
        
        $builder->add('items', 'collection', $itemsConfig);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\BillerBundle\Entity\Bill',
        ));
    }

    public function getName()
    {
        return 'bill';
    }
}