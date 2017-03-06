<?php

namespace ManagementBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;


class StoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //para obtener el objeto con el que se está construyendo el form
        $project = $builder->getData()->getProject();
        $idProject = $project->getId();

        $builder
            ->add('title')
            ->add('rol', EntityType::class, array(
                'class' => 'ManagementBundle:Rol',
                'placeholder' => 'Choose an rol',
                'query_builder' => function (EntityRepository $er) use ($idProject) {

                    return $er->createQueryBuilder('r')
                        ->innerJoin('r.project', 'p', 'WITH', 'r.project = :project')
                        ->setParameter('project', $idProject);
                },
            ))
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
            ->add('points', ChoiceType::class, array(
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '4' => '4',
                    '8' => '8',
                    '10' => '10',
                    '12' => '12',
                    '14' => '14',
                    '16' => '16',
                    '18' => '18',
                    '20' => '20',
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
            ->add('module', EntityType::class, array(
                'class' => 'ManagementBundle:Module',
                'required' => true,
                'placeholder' => 'Choose an module',
                'query_builder' => function (EntityRepository $er) use ($idProject) {

                    return $er->createQueryBuilder('m')
                        ->innerJoin('m.project', 'p', 'WITH', 'm.project = :project')
                        ->setParameter('project', $idProject);
                },
            ))
            ->add('sprint', EntityType::class, array(
                'class' => 'ManagementBundle:Sprint',
                'placeholder' => 'Choose an sprint',
                'query_builder' => function (EntityRepository $er) use ($idProject) {

                    return $er->createQueryBuilder('s')
                        ->innerJoin('s.project', 'p', 'WITH', 's.project = :project')
                        ->setParameter('project', $idProject);
                },
            ));
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
