<?php

namespace ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


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
            ->add('priority', ChoiceType::class, array(
                'choices' => array(
                    '1' => 'BAJA',
                    '3' => 'MEDIA',
                    '5' => 'ALTA',
                )
            ))
            ->add('status', ChoiceType::class, array(
                'choices' => array(
                    '0' => 'NONE',
                    '1' => 'PENDIENTE',
                    '2' => 'EN PROGRESO',
                    '3' => 'REALIZADO',
                    '4' => 'ACEPTADO',
                )
            ))
            ->add('effort', ChoiceType::class, array(
                'choices' => array(
                    '0' => '0h',
                    '1' => '1h',
                    '2' => '2h',
                    '4' => '4h',
                    '8' => '8h',
                    '16' => '16h',
                )
            ))
            ->add('startDate', DateType::class, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd','attr' => array('class' => '')))
            ->add('dueDate', DateType::class, array('widget' => 'single_text', 'format' => 'yyyy-MM-dd', 'attr' => array('class' => '')))
            ->add('sprint')
            ->add('activity')
            ->add('project')
            ->add('parentStory');
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
