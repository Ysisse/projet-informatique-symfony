<?php


namespace App\Controller;


use App\Entity\Groupe;
use App\Form\GroupeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/groupe")
 */
class GroupeController extends AbstractController
{
    /**
     * @Route("/creation", name="creation_groupe", methods={"GET","POST"})
     */
    public function creation_groupe(Request $request): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $groupe = new Groupe();
            $form = $this->createForm(GroupeType::class, $groupe);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($groupe);
                $entityManager->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/groupe/ajout.html.twig', [
                'groupe' => $groupe,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="modifier_groupe", methods={"GET","POST"})
     */
    public function modifier_groupe(Request $request, Groupe $groupe): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $form = $this->createForm(GroupeType::class, $groupe);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/groupe/edit.html.twig', [
                'groupe' => $groupe,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="supprimer_groupe", methods={"DELETE"})
     */
    public function supprimer_groupe(Request $request, Groupe $groupe): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            if ($this->isCsrfTokenValid('delete' . $groupe->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($groupe);
                $entityManager->flush();
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->redirectToRoute('admin');
        }
    }
}