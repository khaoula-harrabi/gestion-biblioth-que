<?php

namespace App\Form;

use App\Entity\Abonnee;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Livre;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre',TextType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Titre"])
            ->add('nbpages',NumberType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Nbre Pages"])
            ->add('dateedition',\Symfony\Component\Form\Extension\Core\Type\DateType::class,['widget'=>'single_text']
                , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Date Edition"])
            ->add('nbreexemplaires',NumberType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Nbre Exemplaire"])
            ->add('prix' ,NumberType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Prix"])
            ->add('isbn',TextType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"ISBN"])
            ->add('editeur',EntityType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Editeur",'class'=>Editeur::class,
                'multiple'=>false ,
                'expanded'=>false ,
                'choice_label'=>'nomediteur'])
            ->add('categorie' ,
                EntityType::class ,
                ['attr'=>['class'=>'form-control'] ,
                'label'=>"Catégorie",
                    'class'=>Categorie::class,
                'multiple'=>false ,
                'expanded'=>false ,
                'choice_label'=>'designation'])
            ->add('auteurs',EntityType::class,
                ['attr'=>['class'=>'form-control'] ,
                    'label'=>"Auteurs",
                'class'=>Auteur::class,
                'multiple'=>true,
                'expanded'=>false,
                'choice_label'=>function($auteur){
                    return $auteur->getPrenom()." ".$auteur->getNom() ;
                }])

            ->add('images', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])

        ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
