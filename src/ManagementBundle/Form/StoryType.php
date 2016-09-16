<?php

namespace ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class StoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('rol')
            ->add('want')
            ->add('soThat')
            ->add('priority')
            ->add('status')
            ->add('effort')
            ->add('startDate', DateType::class,array('widget'=>'single_text', 'format' => 'yyyy-MM-dd','attr'=>array('class'=>'')))
            ->add('dueDate', DateType::class,array('widget'=>'single_text', 'format' => 'yyyy-MM-dd','attr'=>array('class'=>'')))
            ->add('sprint')
            ->add('activity')
            ->add('project')
            ->add('parentStory')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ManagementBundle\Entity\Story'
        ));
    }
}
