<?php

namespace App\Form;

use App\Entity\Race;
use App\Entity\Classe;
use App\Entity\Survivant;
use App\Entity\SurvivantFilter;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class SurvivantFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('raceName',EntityType::class,[
                'class' => Race::class,
                'required' => false ,
                // 'multiple' => true,
                // 'expanded' => true,
                'query_builder'=> function (EntityRepository $er){
                    return $er->createQueryBuilder('u');
                }
                
            ])
            ->add('ClasseName',EntityType::class,[
                'class' => Classe::class,
                'multiple' => true,
                'expanded' => true,
                'query_builder'=> function (EntityRepository $ert){
                    return $ert->createQueryBuilder('u');
                }
                
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => SurvivantFilter::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    // public function getBlockPrefix()
    // {
    //     return '';
    // }
}
