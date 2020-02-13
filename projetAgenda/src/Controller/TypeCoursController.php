<?php

namespace App\Controller;

use App\Entity\TypeCours;
use App\Form\TypeCoursType;
use App\Repository\TypeCoursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/cours")
 */
class TypeCoursController extends AbstractController
{
    /**
     * @Route("/", name="type_cours_index", methods={"GET"})
     */
    public function index(TypeCoursRepository $typeCoursRepository): Response
    {
        return $this->render('type_cours/index.html.twig', [
            'type_cours' => $typeCoursRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="type_cours_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $typeCour = new TypeCours();
        $form = $this->createForm(TypeCoursType::class, $typeCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($typeCour);
            $entityManager->flush();

            return $this->redirectToRoute('type_cours_index');
        }

        return $this->render('type_cours/new.html.twig', [
            'type_cour' => $typeCour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_cours_show", methods={"GET"})
     */
    public function show(TypeCours $typeCour): Response
    {
        return $this->render('type_cours/show.html.twig', [
            'type_cour' => $typeCour,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="type_cours_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, TypeCours $typeCour): Response
    {
        $form = $this->createForm(TypeCoursType::class, $typeCour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('type_cours_index');
        }

        return $this->render('type_cours/edit.html.twig', [
            'type_cour' => $typeCour,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="type_cours_delete", methods={"DELETE"})
     */
    public function delete(Request $request, TypeCours $typeCour): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeCour->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($typeCour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('type_cours_index');
    }
}
