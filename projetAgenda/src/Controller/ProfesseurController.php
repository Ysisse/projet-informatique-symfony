<?php


namespace App\Controller;


use App\Entity\Professeur;
use App\Form\ProfesseurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/professeur")
 */
class ProfesseurController extends AbstractController
{
    /**
     * @Route("/creation", name="creation_professeur", methods={"GET","POST"})
     */
    public function creation_professeur(Request $request): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $professeur = new Professeur();
            $form = $this->createForm(ProfesseurType::class, $professeur);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($professeur);
                $entityManager->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/professeur/ajout.html.twig', [
                'professeur' => $professeur,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="modifier_professeur", methods={"GET","POST"})
     */
    public function modifier_professeur(Request $request, Professeur $professeur): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $form = $this->createForm(ProfesseurType::class, $professeur);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/professeur/edit.html.twig', [
                'professeur' => $professeur,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="supprimer_professeur", methods={"DELETE"})
     */
    public function supprimer_professeur(Request $request, Professeur $professeur): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            if ($this->isCsrfTokenValid('delete' . $professeur->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($professeur);
                $entityManager->flush();
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->redirectToRoute('admin');
        }
    }
}