<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\ConnexionType;
use App\Repository\AdminRepository;
use App\Repository\CoursRepository;
use App\Repository\GroupeRepository;
use App\Repository\ModuleRepository;
use App\Repository\ProfesseurRepository;
use App\Repository\TypeCoursRepository;
use App\Repository\VacancesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Session\Session;

class IndexController extends AbstractController
{

    /**
     * @Route("/", name="home");
     * @param CoursRepository $coursRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function home(
        CoursRepository $coursRepository,
        ModuleRepository $moduleRepository,
        TypeCoursRepository $typeCoursRepository,
        GroupeRepository $groupeRepository
    ) : Response
    {
        $lesCours = $coursRepository->findAll();
        $lesGroupes = array();
        $lesProfs = array();
        foreach ($lesCours as $id => $cour){
            $cour->getTypeCours();
            $groupe = "";
            foreach ($cour->getGroupes()->toArray() as $idGroupe => $groupes){
                $groupe .= $groupes->getIntitule() . " ";
            }
            $lesGroupes[$id] = $groupe;
            $professeur = "";
            foreach ($cour->getProfesseurs()->toArray() as $prof){
                $professeur .= strval($prof->getNom()) . " ";
            }
            $lesProfs[$id] = $professeur;
        }
        $this->get('session')->set('pageActuelle', "home");
        return $this->render('home/home.html.twig', [
            'cours' => $lesCours,
            'groupesCours' => $lesGroupes,
            'professeursCours' => $lesProfs,
            'modules' => $moduleRepository->findAll(),
            'groupes' => $groupeRepository->findAll(),
            'typesCours' => $typeCoursRepository->findAll()
        ]);
    }

    /**
     * @Route("/login", name="login", methods={"GET","POST"});
     */
    public function login(AdminRepository $adminRepository, Request $request) : Response
    {
        $this->get('session')->set('error', null);
        $admin = new Admin();
        $form = $this->createForm(ConnexionType::class, $admin);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $login = $form->get('login')->getData();
            $password = $form->get('password')->getData();
            $admin = $adminRepository->findOneByLogin($login);
            if($admin != null and $admin->getLogin()==$login and $admin->getPassword()==$password){
                $user = $admin->getLogin();
                $this->get('session')->set('user', $user);
                $this->get('session')->set('pageActuelle', "admin");
                $this->get('session')->set('error', null);
                return $this->redirectToRoute('admin');
            } else {
                $this->get('session')->set('error', "ERROR_LOGIN");
            }
        }
        $this->get('session')->set('pageActuelle', "login");
        $admin = new Admin();
        return $this->render('connexion.html.twig', [
            'admin' => $admin,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin", name="admin");
     */
    public function admin(
        CoursRepository $coursRepository,
        ModuleRepository $moduleRepository,
        ProfesseurRepository $professeurRepository,
        GroupeRepository $groupeRepository,
        VacancesRepository $vacancesRepository
    )
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else{
            $module = $moduleRepository->findAll();
            $professeur = $professeurRepository->findAll();
            $groupe = $groupeRepository->findAll();
            $vacances = $vacancesRepository->findAll();

            $cours = $coursRepository->findAll();
            $lesGroupes = array();
            $lesProfs = array();
            foreach ($cours as $id => $cour) {
                $cour->getTypeCours();
                $groupe = "";
                foreach ($cour->getGroupes()->toArray() as $idGroupe => $groupes) {
                    $groupe .= $groupes->getIntitule() . " ";
                }
                $lesGroupes[$id] = $groupe;
                $professeur = "";
                foreach ($cour->getProfesseurs()->toArray() as $prof) {
                    $professeur .= strval($prof->getNom()) . " ";
                }
                $lesProfs[$id] = $professeur;
            }
            $this->get('session')->set('pageActuelle', "admin");
            return $this->render('admin/home.html.twig', [
                "cours" => $cours,
                'groupesCours' => $lesGroupes,
                'professeursCours' => $lesProfs,
                "modules" => $module,
                "professeurs" => $professeur,
                "groupes" => $groupe,
                "vacances" => $vacances
            ]);
        }
    }

    /**
     * @Route("/logout", name="logout");
     */
    public function logout()
    {
        if($this->get('session')->get('user')==null) {
            return $this->redirectToRoute('home');
        }else {
            $this->get('session')->set('user', null);
            return $this->redirectToRoute('home');
        }
    }


}