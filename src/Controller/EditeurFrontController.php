<?php

namespace App\Controller;
use App\Entity\Editeur;
use App\Entity\Livre;
use App\Repository\EditeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditeurFrontController extends AbstractController
{
    /**
     * @Route("/editeur/front", name="editeur_front")
     */
    public function index(EditeurRepository $editeurRepository): Response
    {$repEditeur=$this->getDoctrine()->getRepository(Editeur::class);
        $lesediteurs=$repEditeur->findAll();
        return $this->render('editeur_front/index.html.twig', [
            'editeurs' => $lesediteurs,
        ]);
    }
    /**
     * @Route("/afficher_editeur_front/{id}",name="afficher_editeur_front")
     */
    public function afficher(int $id = -1){
        if($id <=0)
            return $this->RedirectToRoute('editeur_front');
        else{
            $repEditeur=$this->getDoctrine()->getRepository(Editeur::class);
            $lesediteurs=$repEditeur->findAll();
            $repLivre = $this->getDoctrine()->getRepository(Livre::class);
            $LESlivreS=$repLivre->findAll();
            return $this->render('editeur_front/afficher.html.twig',
                ['livre' => $LESlivreS,
                    'id' =>$id,
                    'editeurs' => $lesediteurs,
                ]);
        }}
}
