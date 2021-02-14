<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LivreRepository;
use Symfony\Component\HttpFoundation\Request;
class FrontController extends AbstractController
{
    /**
     * @Route("/front", name="front")
     */
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'controller_name' => 'FrontController',
            'livres' => $livreRepository->findAll(),
        ]);
    }
    /**
     * @Route("/{id}", name="livre_front_show", methods={"GET"},requirements={"id":"\d+"})
     */
    public function show(Livre $livre): Response
    {
        return $this->render('livre/show_front.html.twig', [

            "lien"=>$this->generateUrl('livre_index'),

            'livre' => $livre,
        ]);
    }

}
