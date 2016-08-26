<?php

namespace ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('want')
            ->add('soThat')
            ->add('priority')
            ->add('status')
            ->add('effort')
            ->add('startDate', 'datetime')
            ->add('dueDate', 'datetime')
            ->add('sprint')
            ->add('activity')
            ->add('project')
            ->add('parentStory')
            ->add('rol')
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
