# Projet ProgServ2

## Membres
- Luca Leone  
- Sacha Loskov  
- Ryad Ait-Slimane  

## Thème
Créer une application web de gestion de tâches permettant aux utilisateurs de gérer leur organisation personnelle et de collaborer avec d’autres personnes.  
Le site sera disponible en deux langues (**français/anglais**) et accessible depuis Internet.

## Fonctionnalités

### Pages publiques
- **Accueil** : présentation du service et explication des fonctionnalités.  
- **Inscription** : création de compte avec formulaire et envoi d’un email de confirmation.  
- **Connexion** : formulaire d’authentification.  

### Pages privées (après connexion)
- **Tableau de bord** : aperçu des tâches à venir et résumé des projets.  
- **Gestion des tâches** :
  - Créer, modifier, supprimer une tâche.  
  - Donner un nom, une description facultative, un type personnalisé, un état (*en cours*, *complétée*, *à faire*), une priorité (*Haute*, *Moyenne*, *Faible*) et une date de fin.  
  - Associer une tâche à une catégorie (*Travail, Études, Loisirs, Personnel*).  
- **Profil utilisateur** : modifier ses informations personnelles et son mot de passe.  

### Gestion des rôles
- **Utilisateur standard** : gère ses propres tâches.  
- **Administrateur** : peut gérer/modérer les utilisateurs et voir toutes les tâches.  

### Fonctionnalités optionnelles
- Gestion des catégories : ajouter/éditer/supprimer des catégories personnalisées.  
- Partage de tâches entre utilisateurs (assigner une tâche à un autre utilisateur).  
- Notifications par email lors de l’ajout ou de la modification d’une tâche partagée.  
- Statistiques personnelles (ex. % de tâches terminées, temps moyen de réalisation).  

## Contraintes
- Toute l'équipe doit contribuer au projet et tous les membres doivent être en mesure de l'expliquer en détail si on leur demande.  
- Le projet respecte le cahier des charges initial.  
- Le projet doit être terminé et remis selon les instructions indiquées dans la section **Soumission**.  
- Le projet est réalisé en **PHP**, avec une base de données **MySQL/MariaDB**, sans frameworks externes (*Laravel, Symfony, etc.*).  
- Le projet doit respecter les bonnes pratiques étudiées en **Programmation serveur 1 (ProgServ1)** :
  - Validation côté serveur et client.  
  - Nettoyage des saisies utilisateur.  
  - Protection contre les attaques courantes (*SQL injection, XSS*).  
  - Code lisible, agréable à lire et explicite.  
- Vous devez indiquer vos sources si vous avez utilisé des éléments dont vous n'êtes pas l'auteur (code trouvé en ligne, généré par IA, etc.) et préciser dans le rapport final à quelles fins.  
- **Plagiat = note 1**. Si plusieurs groupes sont impliqués, tous recevront la note de 1.  
