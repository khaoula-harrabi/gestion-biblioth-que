<?php

namespace App\Controller;

use App\Entity\Abonnee;
use App\Entity\Auteur;
use App\Entity\Editeur;
use App\Entity\User;
use App\Form\AbonneeType;
use App\Form\EditeurType;
use App\Form\EditUserType;
use App\Repository\AbonneeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class AbonneeController extends AbstractController
{
    /**
     * @Route("/", name="utilisateurs_index", methods={"GET"})
     */
    public function index(UserRepository $abonneeRepository): Response
    {
        return $this->render('admin/index.html.twig', [
            'titre'=>'utilisateurs' ,
            'soustitre'=>'Index',
            "lien"=>$this->generateUrl('utilisateurs_index'),
            'users' => $abonneeRepository->findAll(),


        ]);
    }
    /**
     * @Route("/edit/{id}", name="modifier_user", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('message','Utilisateurs modifié avec succés');

            return $this->redirectToRoute('utilisateurs_index');
        }

        return $this->render('admin/edit.html.twig', [
            'titre'=>'utilisateurs' ,
            'soustitre'=>'Editer',
            "lien"=>$this->generateUrl('utilisateurs_index'),

            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/supprimer/{id}", name="supprimer_user")
     */
    public function supprimer(int $id=-1){
        if ($id <= 0)
            return $this->redirectToRoute('utilisateurs_index');
        else {
            $repUser=$this->getDoctrine()->getRepository(User::class);
            $unuser=$repUser->findOneBy(['id'=>$id]) ;
            $em=$this->getDoctrine()->getManager() ;
            $em->remove($unuser);
            $em->flush();
            return $this->redirectToRoute('utilisateurs_index');

        }

    }



}

