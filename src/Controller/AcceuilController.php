<?php

namespace App\Controller;

use App\Entity\Abonnee;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Editeur;
use App\Entity\Emprunt;
use App\Entity\Livre;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AcceuilController extends AbstractController
{
    /**
     * @Route("/acceuil", name="acceuil")
     */
    public function index():Response
    {      $nbauteurs= count($this->getDoctrine()->getRepository(Auteur::class)->findAll()) ;
        $nbEditeurs= count($this->getDoctrine()->getRepository(Editeur::class)->findAll()) ;
        $nbCategores= count($this->getDoctrine()->getRepository(Categorie::class)->findAll()) ;
        $nblivres= count($this->getDoctrine()->getRepository(Livre::class)->findAll()) ;
        $nbusers= count($this->getDoctrine()->getRepository(User::class)->findAll()) ;
       // $nbemprunts= count($this->getDoctrine()->getRepository(Emprunt::class)->findAll()) ;

        return $this->render('acceuil/index.html.twig', [
            'titre'=>'Acceuil' ,
            'soustitre'=>' ',
            "lien"=>$this->generateUrl('acceuil'),

            'nbAuteurs' => $nbauteurs,
            'nbEdit'=>$nbEditeurs ,
            'nbCat' =>$nbCategores ,
            'nblivres'=>$nblivres ,
            'nbusers'=>$nbusers,
            //'nbemprunts'=>$nbemprunts

        ]);
    }
}
