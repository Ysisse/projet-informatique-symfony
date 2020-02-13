<?php


namespace App\Controller;


use App\Entity\Module;
use App\Form\ModuleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/module")
 */
class ModuleController extends AbstractController
{
    /**
     * @Route("/creation", name="creation_module", methods={"GET","POST"})
     */
    public function creation_module(Request $request): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $module = new Module();
            $form = $this->createForm(ModuleType::class, $module);
            $form->handleRequest($request);
            $this->get('session')->set('pageActuelle', "admin");
            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($module);
                $entityManager->flush();

                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/module/ajout.html.twig', [
                'module' => $module,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="modification_module", methods={"GET","POST"})
     */
    public function modification_module(Request $request, Module $module): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $form = $this->createForm(ModuleType::class, $module);
            $form->handleRequest($request);
            $this->get('session')->set('pageActuelle', "admin");
            if ($form->isSubmitted() && $form->isValid()) {
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('admin');
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/module/edit.html.twig', [
                'module' => $module,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/{id}", name="supprimer_module", methods={"DELETE"})
     */
    public function supprimer_module(Request $request, Module $module): Response
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            if ($this->isCsrfTokenValid('delete' . $module->getId(), $request->request->get('_token'))) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($module);
                $entityManager->flush();
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->redirectToRoute('admin');
        }
    }
}