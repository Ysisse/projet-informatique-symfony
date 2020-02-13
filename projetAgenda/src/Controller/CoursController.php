<?php

namespace App\Controller;




use App\Entity\Cours;
use App\Form\CoursType;
use Doctrine\DBAL\Types\DateType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 *  @Route("/admin/cours")
 */
class CoursController extends AbstractController
{

    /**
     * @Route("/creation", name="creation_cours", methods={"GET","POST"})
     */
    public function creation_cours(Request $request): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $cour = new Cours();
            $form = $this->createForm(CoursType::class, $cour);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($cour);
                $entityManager->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/cours/ajout.html.twig', [
                'cour' => $cour,
                'form' => $form->createView(),
            ]);
        }
    }
    /**
     * @Route("/{id}", name="detail_cours", methods={"GET"})
     */
    public function detail_cours(Cours $cours): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/cours/detail.html.twig', [
                'cours' => $cours,
            ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="modification_cours", methods={"GET","POST"})
     */
    public function modification_cours(Request $request, Cours $cour): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $form = $this->createForm(CoursType::class, $cour);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/cours/edit.html.twig', [
                'cour' => $cour,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}/supprimer", name="supprimer_cours", methods={"DELETE"})
     */
    public function supprimer_cours(Request $request, Cours $cour): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            if ($this->isCsrfTokenValid('delete' . $cour->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($cour);
                $entityManager->flush();
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->redirectToRoute('admin');
        }
    }
}
