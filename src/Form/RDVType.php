<?php

namespace App\Form;

use App\Entity\RDV;
use App\Entity\Statut;
<<<<<<< HEAD
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
=======
use App\Entity\Medecin;
use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
>>>>>>> 126c2038c56ab7d783ae4937d1dba1ed41d507c3

class RDVType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
<<<<<<< HEAD
        $builder            
            ->add('statut', EntityType::class, array('class'=>Statut::class, 'choice_label' => 'libelle'))
            ->add('save', SubmitType::class, array('label' => 'Modifier le RDV'));            
=======
        $builder
            ->add('date')
            ->add('heure')
            ->add('medecin', EntityType::class, array(
                'class'=>Medecin::class,
                'choice_label'=>'nom'
            ))
            ->add('submit', SubmitType::class)
>>>>>>> 126c2038c56ab7d783ae4937d1dba1ed41d507c3
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RDV::class,
        ]);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 126c2038c56ab7d783ae4937d1dba1ed41d507c3
