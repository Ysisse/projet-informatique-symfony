<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\Cours;
use App\Entity\Groupe;
use App\Entity\Module;
use App\Entity\Professeur;
use App\Entity\Salle;
use App\Entity\TypeCours;
use App\Entity\Vacances;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;

class DataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $admin = new Admin();
        $admin->setLogin("o2172321")
              ->setPassword("o2172321");
        $manager->persist($admin);

        $lesVacances = array(
            array(new \DateTime("2019-10-28"), new \DateTime("2019-11-1")),
            array(new \DateTime("2019-12-23"), new \DateTime("2020-1-3")),
            array(new \DateTime("2020-2-24"), new \DateTime("2020-2-28"))
        );
        foreach ($lesVacances as $id => $uneVacance){
            $vacance = new Vacances();
            $vacance->setDateDebut($uneVacance[0])
                    ->setDateFin($uneVacance[1]);
            $manager->persist($vacance);
        }

        $lesTypesCoursNonFonctionnels = array(
            array("CM", "#fa8072"),
            array("TD", "#9bdafc"),
            array("TP", "#5DB054")
        );
        $lesTypesCours = new ArrayCollection();
        foreach ($lesTypesCoursNonFonctionnels as $id => $unTypeCours){
            $typeCours = new TypeCours();
            $typeCours->setIntitule($unTypeCours[0])
                      ->setCouleur($unTypeCours[1]);
            $manager->persist($typeCours);
            $lesTypesCours->add($typeCours);
        }

        $lesGroupesNonFonctionnels = array(
            "Groupe 1",
            "Groupe 2"
        );
        $lesGroupes = new ArrayCollection();
        foreach ($lesGroupesNonFonctionnels as $id => $unGroupe){
            $groupe = new Groupe();
            $groupe->setIntitule($unGroupe);
            $manager->persist($groupe);
            $lesGroupes->add($groupe);
        }
        $tousLesGroupes = array($lesGroupes->get(0), $lesGroupes->get(1));
        $groupe1 = array($lesGroupes->get(0));
        $groupe2 = array($lesGroupes->get(1));

        $lesSallesNonFonctionnelles = array(
            "E01",
            "E02",
            "E03",
            "E04",
            "E05",
            "E06",
            "E07",
            "E08",
            "E09",
            "E11",
            "E12",
            "E13",
            "E14",
            "E15",
            "E16",
            "E17",
            "E18",
            "E19",
            "ES01",
            "ES02",
            "ES03",
            "ES04",
            "ES05",
            "Amphi S",
            "Amphi 1 Sciences",
            "Amphi 2 Sciences",
            "Amphi 3 Sciences",
            "Amphi 4 Sciences",
            "Amphi Herbrand",
            "Amphi IRD",
            "Le Bouillon",
            "Amphi STAPS 1",
            "Amphi STAPS 2",
            "Amphi STAPS 3",
            "Amphi STAPS 4",
            "S301",
            "S302",
            "S303",
            "S304",
            "S305",
            "S306",
            "S307",
            "S308",
            "S309",
            "S310",
            "S311",
            "S312",
            "S313",
            "S201",
            "S202",
            "S203",
            "S204",
            "S205",
            "S206",
            "S207",
            "S208",
            "S209",
            "S210",
            "S211",
            "S212",
            "S213",
            "S101",
            "S102",
            "S103",
            "S104",
            "S105",
            "S106",
            "S107",
            "S108",
            "S109",
            "S110",
            "S111",
            "S112",
            "S113"
        );
        $lesSalles = new ArrayCollection();
        foreach ($lesSallesNonFonctionnelles as $id => $uneSalle){
            $salle = new Salle();
            $salle->setIntitule($uneSalle);
            $manager->persist($salle);
            $lesSalles->add($salle);
        }

        $lesProfesseursNonFonctionnels = array(
            "DION",
            "KAHLEM",
            "TODINCA",
            "ALZY",
            "DIEP",
            "IANC",
            "PELLETIER",
            "MOAL",
            "SAKHO",
            "COUVREUR",
            "PEREZ"
        );
        $lesProfesseurs = new ArrayCollection();
        foreach ($lesProfesseursNonFonctionnels as $id => $unProfesseur){
            $professeur = new Professeur();
            $professeur->setNom($unProfesseur);
            $manager->persist($professeur);
            $lesProfesseurs->add($professeur);
        }

        $lesModulesNonFonctionnels = array(
            array("Framework web", 14, 0, 22),
            array("Environnement Economique de l'entreprise", 20, 0, 0),
            array("Programmation N-Tiers",18, 0, 30),
            array("Recherche opérationnelle", 15, 15, 0),
            array("Droit", 20, 0, 0),
            array("Anglais", 0, 20, 0),
            array("Projet Informatique 2", 8, 0, 8)
        );
        $lesModules = new ArrayCollection();
        foreach ($lesModulesNonFonctionnels as $id => $unModule){
            $module = new Module();
            $module->setIntitule($unModule[0])
                   ->setNbHCM($unModule[1])
                   ->setNbHTD($unModule[2])
                   ->setNbHTP($unModule[3]);
            $manager->persist($module);
            $lesModules->add($module);
        }

        $lesCours = array(
            array(
                $lesModules->get(4),
                new \DateTime("2020-01-13"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(0)),
                $lesTypesCours->get(0),
                $tousLesGroupes,
                $lesSalles->get(11)
            ),

            array(
                $lesModules->get(2),
                new \DateTime("2020-01-14"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(1)),
                $lesTypesCours->get(2),
                $groupe2,
                $lesSalles->get(8)
            ),
            array(
                $lesModules->get(2),
                new \DateTime("2020-01-14"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(10)),
                $lesTypesCours->get(2),
                $groupe1,
                $lesSalles->get(0)
            ),

            array(
                $lesModules->get(3),
                new \DateTime("2020-01-15"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(2)),
                $lesTypesCours->get(0),
                $tousLesGroupes,
                $lesSalles->get(15)
            ),
            array(
                $lesModules->get(2),
                new \DateTime("2020-01-15"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(1)),
                $lesTypesCours->get(2),
                $groupe2,
                $lesSalles->get(1)
            ),
            array(
                $lesModules->get(5),
                new \DateTime("2020-01-15"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(3)),
                $lesTypesCours->get(1),
                $groupe1,
                $lesSalles->get(30)
            ),
            array(
                $lesModules->get(5),
                new \DateTime("2020-01-15"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(3)),
                $lesTypesCours->get(1),
                $groupe2,
                $lesSalles->get(30)
            ),

            array(
                $lesModules->get(3),
                new \DateTime("2020-01-16"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(4)),
                $lesTypesCours->get(1),
                $tousLesGroupes,
                $lesSalles->get(15)
            ),
            array(
                $lesModules->get(2),
                new \DateTime("2020-01-16"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(10)),
                $lesTypesCours->get(2),
                $groupe1,
                $lesSalles->get(1)
            ),
            array(
                $lesModules->get(1),
                new \DateTime("2020-01-16"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(5)),
                $lesTypesCours->get(0),
                $tousLesGroupes,
                $lesSalles->get(12)
            ),

            array(
                $lesModules->get(0),
                new \DateTime("2020-01-17"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(9)),
                $lesTypesCours->get(0),
                $tousLesGroupes,
                $lesSalles->get(23)
            ),
            array(
                $lesModules->get(2),
                new \DateTime("2020-01-17"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(7)),
                $lesTypesCours->get(0),
                $tousLesGroupes,
                $lesSalles->get(23)
            ),
            array(
                $lesModules->get(0),
                new \DateTime("2020-01-17"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(8)),
                $lesTypesCours->get(2),
                $groupe2,
                $lesSalles->get(6)
            ),
            array(
                $lesModules->get(0),
                new \DateTime("2020-01-17"),
                new \DateTime(),
                new \DateTime(),
                array($lesProfesseurs->get(9)),
                $lesTypesCours->get(2),
                $groupe1,
                $lesSalles->get(7)
            )
        );
        $lesHoraires = array(
            array(array(13, 30), array(16, 00)),

            array(array(10,15), array(12,15)),
            array(array(10,15), array(12,15)),

            array(array(8,30), array(10,0)),
            array(array(10,15), array(12,15)),
            array(array(10,15), array(12,15)),
            array(array(13,30), array(15,30)),

            array(array(8,30), array(10,0)),
            array(array(10,15), array(12,15)),
            array(array(13,30), array(16,30)),

            array(array(8,0), array(10,0)),
            array(array(10,15), array(12,15)),
            array(array(14,0), array(17,0)),
            array(array(14,0), array(17,0)),
        );
        $nbSemaine = 0;
        $nbSemaineMax = 9;
        for($i=0; $i<$nbSemaineMax; $i++) {
            $cpt = 0;
            if($nbSemaine<($nbSemaineMax+1)) {
                foreach ($lesCours as $idCours => $unCours) {
                    $cours = new Cours();
                    $date = new \DateTime($unCours[1]->format('Y-m-d'));
                    $dateString = $date->format('Y-m-d');
                    date_timestamp_set($date, strtotime("$dateString + $nbSemaine week"));
                    $peutInserer = True;
                    foreach ($lesVacances as $id => $uneVacance) {
                        $dateDebutVacancesInt = $uneVacance[0]->getTimestamp();
                        $dateFinVacancesInt = $uneVacance[1]->getTimestamp();
                        $dateVerificationInt = $date->getTimestamp();
                        if ($dateVerificationInt >= $dateDebutVacancesInt && $dateVerificationInt <= $dateFinVacancesInt) {
                            $peutInserer = False;
                        }
                    }
                    if ($peutInserer) {
                        $cours->setModule($unCours[0])
                            ->setDate(new \DateTime($date->format('Y-m-d')))
                            ->setHeureDebut($unCours[2]->setTime($lesHoraires[$cpt][0][0], $lesHoraires[$cpt][0][1]))
                            ->setHeureFin($unCours[3]->setTime($lesHoraires[$cpt][1][0], $lesHoraires[$cpt][1][1]))
                            ->setSalle($unCours[7])
                            ->setTypeCours($unCours[5]);
                        foreach ($unCours[4] as $id => $unProfesseur) {
                            $cours->addProfesseur($unProfesseur);
                        }
                        foreach ($unCours[6] as $id => $unGroupe) {
                            $cours->addGroupe($unGroupe);
                        }
                        $manager->persist($cours);
                        $cpt++;
                    } else {
                        $i--;
                    }
                }
            }
            $nbSemaine++;
        }

        $manager->flush();
    }
}
