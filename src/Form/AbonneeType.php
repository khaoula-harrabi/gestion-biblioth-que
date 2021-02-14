<?php

namespace App\Form;

use App\Entity\Abonnee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AbonneeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomabonne', TextType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Nom Abonné"])
            ->add('adresse' , TextType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Adresse"])
            ->add('pays' , TextType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Pays"])
            ->add('telephone' , TextType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"téléphone"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Abonnee::class,
        ]);
    }
}
