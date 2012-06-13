<?php

namespace Dime\TimetrackerBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email')
        ;
    }

    public function getName()
    {
        return 'dime_timetrackerbundle_usertype';
    }
}
