<?php

namespace App\Controller;

use App\Entity\Emprunt;
use App\Form\EmpruntType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/emprunt")
 */
class EmpruntController extends AbstractController
{
    /**
     * @Route("/", name="emprunt")
     */
    public function index(): Response
    {$repEmprunt=$this->getDoctrine()->getRepository(Emprunt::class) ;
        $lesEmprunts=$repEmprunt->findall() ;
        return $this->render('emprunt/index.html.twig', [
            'titre'=>'Emprunts' ,
            'soustitre'=>'Index',
            "lien"=>$this->generateUrl('emprunt'),

            'listeEmprunts' => $lesEmprunts,
        ]);

    }
    /**
     * @Route("/nouveau", name="nouvel_emprunt")
     */
    public function nouveau(Request $request){
        $emprunt=new Emprunt();
        $frm=$this->createForm(EmpruntType::class,$emprunt);
        $frm->add('Valider',SubmitType::class);
        $frm->handleRequest($request) ;
        if ($frm->isSubmitted() && $frm->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($emprunt);
            $em->flush();
            return $this->redirectToRoute('nouvel_emprunt') ;
        }
        return $this->render('emprunt/nouveau.html.twig',
            ['frm'=>$frm->createView(),
            ]);
    }
    /**
     * @Route("/edit/{id}", name="edit_emprunt")
     */
    public function edit(int $id= -1 , Request $request)
    {
        if ($id <= 0)
            return $this->redirectToRoute('emprunt');
        else {
            $repEmprunt=$this->getDoctrine()->getRepository(Emprunt::class);
            $unEmprunt=$repEmprunt->findOneBy(['id'=>$id]) ;
            $frm = $this->createForm(EmpruntType::class , $unEmprunt) ;
            $frm->add('Modifier' , SubmitType::class) ;
            $frm->handleRequest($request) ;
            if ($frm->isSubmitted() && $frm->isValid()){
                $em=$this->getDoctrine()->getManager() ;
                $em->flush();
                return $this->redirectToRoute('emprunt') ;
            }
            return $this->render('emprunt/edit.html.twig' ,
                [
                    'frm'=> $frm->createView() ,
                ]);

        }
    }
    /**
     * @Route("/supprimer/{id}", name="supprimer_emprunt")
     */
    public function supprimer(int $id=-1){
        if ($id <= 0)
            return $this->redirectToRoute('emprunt');
        else {
            $repEmprunt=$this->getDoctrine()->getRepository(Emprunt::class);
            $unEmprunt=$repEmprunt->findOneBy(['id'=>$id]) ;
            $em=$this->getDoctrine()->getManager() ;
            $em->remove($unEmprunt);
            $em->flush();
            return $this->redirectToRoute('emprunt');

        }

    }
}
