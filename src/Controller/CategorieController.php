<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{
    /**
     * @Route("/", name="categorie_index", methods={"GET"})
     */
    public function index(): Response
    {$repCategorie=$this->getDoctrine()->getRepository(Categorie::class);
    $lesCategories =$repCategorie->findAll();

    return $this->render('categorie/index.html.twig', [
            'titre'=>'Catégorie' ,
            'soustitre'=>'Index',
            "lien"=>$this->generateUrl('categorie_index'),

            'categories' => $lesCategories,
        ]);
    }

    /**
     * @Route("/new", name="categorie_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/new.html.twig', [
            'titre'=>'Catégorie' ,
            'soustitre'=>'Nouveau',
            "lien"=>$this->generateUrl('categorie_index'),

            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/show/{id}", name="categorie_show")
     */
    public function show(int $id = -1)
    { if($id <= 0 )
        return $this->redirectToRoute('categorie_index')  ;
    else{
        $repCat=$this->getDoctrine()->getRepository(Categorie::class);
        $unCat=$repCat->findOneBy(['id'=>$id]) ;

    }
        return $this->render('categorie/show.html.twig', [
            'titre'=>'Catégorie' ,
            'soustitre'=>' ',
            "lien"=>$this->generateUrl('categorie_index'),

            'categorie' => $unCat
        ]);
    }

    /**
     * @Route("/{id}/edit", name="categorie_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Categorie $categorie): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('categorie_index');
        }

        return $this->render('categorie/edit.html.twig', [
            'titre'=>'Catégorie' ,
            'soustitre'=>'Editer',
            "lien"=>$this->generateUrl('categorie_index'),

            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("supprimer/{id}", name="categorie_delete_2")
     */
    public function supprimer(Request $request,int $id=-1): Response
    {
        if($id <=0 ) {
            return $this->redirectToRoute('categorie_index');

        }
        else {
            $categorie = $this->getDoctrine()->getRepository(Categorie::class)->findOneBy(['id'=>$id]) ;
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
            return $this->redirectToRoute('categorie_index');

        }

    }

    /**
     * @Route("/{id}", name="categorie_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Categorie $categorie): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($categorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('categorie_index');
    }
}
