<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/admin", name="admin")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="Allusers", methods={"GET"})
     */
    public function index(UserRepository $users): Response
    {
        return $this->render('admin/index.html.twig', [
            'titre'=>'Utilisateurs' ,
            'soustitre'=>'Index',
            "lien"=>$this->generateUrl("Allusers"),
            "users" => $users->findAll() ,
        ]);
    }



}
