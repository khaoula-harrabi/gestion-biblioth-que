<?php

namespace App\Controller;

use App\Entity\Editeur;
use App\Entity\Livre;
use App\Form\EditeurType;
use App\Repository\EditeurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Route("/editeur")
 */
class EditeurController extends AbstractController
{
    /**
     * @Route("/", name="editeur_index")
     */
    public function index(): Response
    {$repEditeur=$this->getDoctrine()->getRepository(Editeur::class);
    $lesEditeurs=$repEditeur->findAll();
        return $this->render('editeur/index.html.twig', [
            'titre'=>'Editeurs' ,
            'soustitre'=>'Index',
            "lien"=>$this->generateUrl('editeur_index'),
            'editeurs' => $lesEditeurs,
        ]);
    }

    /**
     * @Route("/new", name="editeur_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $editeur = new Editeur();
        $form = $this->createForm(EditeurType::class, $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($editeur);
            $entityManager->flush();

            return $this->redirectToRoute('editeur_index');
        }

        return $this->render('editeur/new.html.twig', [
            'titre'=>'Editeur' ,
            'soustitre'=>'Nouveau',
            "lien"=>$this->generateUrl('editeur_index'),

            'editeur' => $editeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="editeur_show")
     */

    public function show(int $id = -1){
        if($id <= 0 )
            return $this->redirectToRoute('editeur_index')  ;
        else{
            $repEditeur=$this->getDoctrine()->getRepository(Editeur::class);
            $unEditeur=$repEditeur->findOneBy(['id'=>$id]) ;

            return $this->render('editeur/show.html.twig',
                [    'titre'=>'Editeur' ,
                    'soustitre'=>' ',
                    "lien"=>$this->generateUrl('editeur_index'),

                    'editeur' => $unEditeur,
                ]);

        }


    }

    /**
     * @Route("/{id}/edit", name="editeur_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Editeur $editeur): Response
    {
        $form = $this->createForm(EditeurType::class, $editeur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('editeur_index');
        }

        return $this->render('editeur/edit.html.twig', [
            'titre'=>'Editeurs' ,
            'soustitre'=>'Editer',
            "lien"=>$this->generateUrl('editeur_index'),

            'editeur' => $editeur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="editeur_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Editeur $editeur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$editeur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($editeur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('editeur_index');
    }
    /**
     * @Route("/supprimer/{id}", name="editeur_delete_2")
     */
    public function supprimer(Request $request,int $id = -1): Response
    {
        if ($id > 0) {
            $editeur = $this->getDoctrine()->getRepository(Editeur::class)->findOneBy(['id'=> $id]) ;
            $entityManager = $this->getDoctrine()->getManager();
            $livres=$editeur->getLivres() ;
            if (!$livres){
                $entityManager->remove($editeur);
                $entityManager->flush();
            }
            else{
                return  new Response("<h1>Imposible de supprimer l'Editeur</h1> ") ;
            }

        }

        return $this->redirectToRoute('editeur_index');
    }
}
