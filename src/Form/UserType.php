<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
public function buildForm(FormBuilderInterface $builder, array $options)
{
$builder
    ->add('name', TextType::class, array('attr' => array('class' => 'form-control mb-2')))
    ->add('surname', TextType::class, array('attr' => array('class' => 'form-control mb-2')))
    ->add('gender', ChoiceType::class, array(
        'choices' => array(
            'Male' => 'Male',
            'Female' => 'Female'
        ),
        'attr' => array('class' => 'custom-select ml-2 mb-2')
    ))
    ->add('age', IntegerType::class, array('attr' => array('class' => 'form-control mb-2')))
    ->add('image', FileType::class, array('data_class' => null,
        'attr' => array('class' => 'form-control-file')
    ))
;
}
}