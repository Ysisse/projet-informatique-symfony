<?php


namespace App\Controller;


use App\Entity\Vacances;
use App\Form\VacancesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/vacances")
 */
class VacancesController extends AbstractController
{
    /**
     * @Route("/creation", name="creation_vacances", methods={"GET","POST"})
     */
    public function creation_vacances(Request $request): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $vacance = new Vacances();
            $form = $this->createForm(VacancesType::class, $vacance);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($vacance);
                $entityManager->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/vacances/ajout.html.twig', [
                'vacance' => $vacance,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="modifer_vacances", methods={"GET","POST"})
     */
    public function modifer_vacances(Request $request, Vacances $vacance): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $form = $this->createForm(VacancesType::class, $vacance);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/vacances/edit.html.twig', [
                'vacance' => $vacance,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="supprimer_vacances", methods={"DELETE"})
     */
    public function supprimer_vacances(Request $request, Vacances $vacance): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            if ($this->isCsrfTokenValid('delete' . $vacance->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($vacance);
                $entityManager->flush();
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->redirectToRoute('admin');
        }
    }
}