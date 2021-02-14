<?php

namespace App\Controller;

use App\Entity\Auteur;
use App\Form\AuteurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/auteur")
 */
class AuteurController extends AbstractController
{
    /**
     * @Route("/", name="index_auteur")
     */

    public function index(): Response
    {   $repAuteur=$this->getDoctrine()->getRepository(Auteur::class) ;
        $lesAuteurs=$repAuteur->findall() ;
        return $this->render('auteur/index.html.twig', [
            'titre'=>'Auteurs' ,
            'soustitre'=>'Index',
            "lien"=>$this->generateUrl('index_auteur'),

            'listeAuteurs' => $lesAuteurs,
        ]);
    }
    /**
     * @Route("/nouveau", name="nouvel_auteur")
     */
    public function nouveau(Request $request) {
        $auteur = new Auteur() ;
        $frm = $this->createForm(AuteurType::class, $auteur);
        $frm->add('valider', SubmitType::class,['attr'=>['class'=>'form-control']]) ;
        $frm->handleRequest($request) ;
        if ($frm->isSubmitted() && $frm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();
            return $this->redirectToRoute('nouvel_auteur') ;
        }
        return $this->render('auteur/nouveau.html.twig',

           [    'titre'=>'Auteurs' ,
               'soustitre'=>'Nouveau',
               "lien"=>$this->generateUrl('index_auteur'),

               'frm'=>$frm->createView() ,
               ] );

    }
    /**
     * @Route("/afficher/{id}", name="afficher_auteur")
     */
    public function afficher(int $id = -1){
            if($id <= 0 )
              return $this->redirectToRoute('index_auteur')  ;
            else{
                $repAuteur=$this->getDoctrine()->getRepository(Auteur::class);
                $unAuteur=$repAuteur->findOneBy(['id'=>$id]) ;

                return $this->render('auteur/afficher.html.twig',
                    [    'titre'=>'Auteurs' ,
                        'soustitre'=>'',
                        "lien"=>$this->generateUrl('index_auteur'),

                        'auteur'=>$unAuteur] );

            }


    }

    /**
     * @Route("/edit/{id}", name="edit_auteur")
     */
    public function edit(int $id= -1 , Request $request)
    {
        if ($id <= 0)
            return $this->redirectToRoute('index_auteur');
        else {
            $repAuteur=$this->getDoctrine()->getRepository(Auteur::class);
            $unAuteur=$repAuteur->findOneBy(['id'=>$id]) ;
            $frm = $this->createForm(AuteurType::class , $unAuteur) ;
            $frm->add('Modifier' , SubmitType::class) ;
            $frm->handleRequest($request) ;
            if ($frm->isSubmitted() && $frm->isValid()){
                $em=$this->getDoctrine()->getManager() ;
                $em->flush();
                return $this->redirectToRoute('index_auteur') ;
            }
            return $this->render('auteur/edit.html.twig' ,
            [    'titre'=>'Auteurs' ,
                'soustitre'=>'Editer',
                "lien"=>$this->generateUrl('index_auteur'),

                'frm'=> $frm->createView() ,
                ]);

        }
    }
    /**
     * @Route("/supprimer/{id}", name="supprimer_auteur")
     */
    public function supprimer(int $id=-1){
        if ($id <= 0)
            return $this->redirectToRoute('index_auteur');
        else {
            $repAuteur=$this->getDoctrine()->getRepository(Auteur::class);
            $unAuteur=$repAuteur->findOneBy(['id'=>$id]) ;
            $em=$this->getDoctrine()->getManager() ;
            $em->remove($unAuteur);
            $em->flush();
            return $this->redirectToRoute('index_auteur');

        }

    }

}
