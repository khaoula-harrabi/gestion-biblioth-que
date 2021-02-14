<?php

namespace App\Controller;
use App\Entity\Auteur;
use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurFrontController extends AbstractController
{
    /**
     * @Route("/auteur/front", name="auteur_front")
     */
    public function index(): Response
    {$repAuteur=$this->getDoctrine()->getRepository(Auteur::class);
        $lauteurs=$repAuteur->findAll();
        return $this->render('auteur_front/index.html.twig', [
            'listeAuteurs' =>$lauteurs,
        ]);
    }
    /**
     * @Route("/afficher_auteur_front/{id}",name="afficher_auteur_front")
     */
    public function afficher(int $id = -1){
        if($id <=0)
            return $this->RedirectToRoute('auteur_front');
        else{
            $repAuteur=$this->getDoctrine()->getRepository(Auteur::class);
            $lauteurs=$repAuteur->findAll();
            $repLivre = $this->getDoctrine()->getRepository(Livre::class);
            $LESlivreS=$repLivre->findAll();

            return $this->render('auteur_front/afficher.html.twig',
                ['livre' => $LESlivreS,
                    'auteur' =>$lauteurs,

                    'id' =>$id,
                ]);
        }}
}
