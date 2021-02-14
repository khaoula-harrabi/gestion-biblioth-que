<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class , ['attr'=>['class'=>'form-control'] ,
                'label'=>"Email"])
            ->add('roles' , ChoiceType::class ,
                ['choices' => [
                    'Utilisateurs' => 'ROLE_USER' ,
                    'Abonne' => 'ROLE_ABONNE' ,
                    'Administrateur' => 'ROLE_ADMIN'
                ] ,
                    'expanded'=> true,
                'multiple'=>true ,
                'label'=>"Roles"])
           // ->add('valider' , SubmitType::class , ['attr'=>['class'=>'form-control']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
