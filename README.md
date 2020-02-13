# projet-informatique-symfony
Il s'agit de mon projet informatique en utilisant le framework Symfony pour mon année L3 MIAGE en groupe de 3.

##Groupes
* AMIOT Erwann
* CHRISTOPHE Marie
* FEREZ Arthur

## Projet Agenda
Le nom de la base de données est ``projetAgenda``.

N'oubliez pas de charger les fixtures. 

Pour se connecter, login : ``o2172321`` et mot de passe : ``o2172321``.

##Fonctionnalité
###Qui fonctionnent :
* Visuel du calendrier avec FullCalendar
* Connexion (sans sécurité)
* Partie Admin
    * Création, modification et suppression d'un Cours
    * Création, modification et suppresion d'un Module
    * Création, modification et suppresion d'un Professeur
    * Création, modification et suppresion d'un Groupe
    * Création, modification et suppresion des Vacances 

###Qui manquent : 
* Ajouter x cours (x>=1)
* Faire les vérifications quand on ajoute/modifie
    * Avant d'ajouter ou de modifier un module / un professeur / un groupe :
        * Il faut regarder si l'intitulé (ou le nom) est déjà pris
    * Avant d'ajouter ou de modifier des vacances : 
        * Regarder si il y a déjà des vacances durant la période
    * Avant d'ajouter ou de modifier un cours :
        * Si le cours est pendant des vacances alors message d'erreur
        * Si le cours est en dehors de la plage horaire
        * Si le cours est déjà sur une période ou un autre cours pour le même groupe a déjà eu lieu 
* Faire le filtre de la page agenda (juste un visuel static est présent)
* Faire les bons changements de page (à vérifier + à faire pour la partie admin)
* Faire des tris sur les pages des admins et dans le formulaire du cours
* Ajouter du JS pour améliorer les formulaires (surtout le formulaire du cours)
* Vérifier si tous les informations importantes sont misent dans la base de données
* Faire une vraie connexion avec la sécurité de Symfony