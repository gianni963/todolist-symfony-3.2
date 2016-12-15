<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TodolistType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr'=> array('class'=>'form-control','style'=> 'margin-top: 10px')))
            ->add('category', TextType::class, array('attr'=> array('class'=>'form-control','style'=> 'margin-top: 10px')))
            ->add('description', TextareaType::class, array('attr'=> array('class'=>'form-control','style'=> 'margin-top: 10px')))
            ->add('importance', ChoiceType::class, array('choices'=>array('high'=>'high','normal'=>'normal','low'=>'low'), 'attr'=>array('class'=>'form-control','style'=> 'margin-top: 10px')))
            ->add('date', DateTimeType::class, array('attr'=> array('class'=>'formcontrol','style'=> 'margin-top: 10px')))
            ->add('Save', SubmitType::class, array('label'=>'Create Task', 'attr'=> array('class'=>'btn btn-primary btn-lg','style'=> 'margin-top: 20px')))    ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Todolist'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_todolist';
    }


}
