<?php

namespace App\Controller;
use App\Entity\Categorie;
use App\Entity\Livre;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieFrontController extends AbstractController
{
    /**
     * @Route("/categorie/front", name="categorie_front")
     */
    public function index(): Response
    { $repCategorie=$this->getDoctrine()->getRepository(Categorie::class);
       $lescats=$repCategorie->findAll();
        return $this->render('categorie_front/index.html.twig', [
            'categories' => $lescats,
        ]);
    }
    /**
     * @Route("/afficher_categorie_front/{id}",name="afficher_categorie_front")
     */
    public function afficher(int $id = -1){
        if($id <=0)
            return $this->RedirectToRoute('categorie_front');
        else{
            $repCategorie=$this->getDoctrine()->getRepository(Categorie::class);
            $lescats=$repCategorie->findAll();
            $repLivre = $this->getDoctrine()->getRepository(Livre::class);
             $LESlivreS=$repLivre->findAll();
            return $this->render('categorie_front/afficher.html.twig',
                ['livre' => $LESlivreS,
                    'id' =>$id,
                    'categories' => $lescats,
                    ]);
        }}
}
