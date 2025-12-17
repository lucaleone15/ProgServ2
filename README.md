# Projet ProgServ2 - TaskBoard

## Membres

- **Luca Leone**
- **Sacha Loskov**
- **Ryad Ait-Slimane**

---

## Thème

Application web de gestion de tâches permettant aux utilisateurs de gérer leur organisation personnelle. Le site est disponible en deux langues (français/anglais).

**URL :** https://taskboard.ch

---

## Fonctionnalités

### Pages publiques

- **Accueil** : Présentation du service avec logo et description
- **Inscription** : Formulaire complet avec envoi d'email de confirmation (PHPMailer)
- **Connexion** : Authentification par username ou email

### Pages privées

- **Tableau de bord Kanban** : Vue moderne en 3 colonnes (À faire, En cours, Terminé)
- **Gestion des tâches** :
    - Création, modification, suppression de tâches
    - Nom, description, statut, priorité, date limite
    - Association à une catégorie (Travail, Études, Loisirs, Personnel)
    - **Changement de statut rapide** directement depuis le Kanban
    - Vue alternative en liste/tableau
- **Système d'authentification** : Sessions sécurisées, middleware de protection
- **Multilingue** : Système de traduction complet (FR/EN) avec sélection dynamique

### Gestion des rôles

- **Utilisateur standard** : Gère uniquement ses propres tâches
- **Administrateur** :
    - Page de gestion des utilisateurs
    - Changement de rôles
    - Suppression d'utilisateurs
    - Protection contre l'auto-modification

### Architecture technique

- **Base de données** : MySQL/MariaDB avec relations (users, tasks)
- **POO** : Classes Task, TasksManager, User, UserManager, Database
- **Autoloader** : Chargement automatique des classes
- **Sécurité** :
    - Hashage des mots de passe (password_hash)
    - Validation côté serveur
    - Échappement des sorties (htmlspecialchars)
    - Requêtes préparées (PDO)
- **Design responsive** : Interface moderne avec CSS Classless

---

## Architecture de l'application

### Structure des fichiers

```
taskboard/
├── public/
│   ├── admin/
│   │   ├── users.php                       Gestion utilisateurs
│   │   ├── create-admin.php                Création compte admin
│   ├── assets/
│   │   ├── css/
│   │   └── img/
│   ├── auth/
│   │   ├── login.php                       Connexion
│   │   ├── register.php                    Inscription
│   │   └── logout.php                      Déconnexion
│   ├── tasks/
│   │   ├── index.php                       Vue Kanban/Liste
│   │   ├── create.php                      Création tâche
│   │   ├── edit.php                        Modification tâche
│   │   ├── view.php                        Détails tâche
│   │   ├── delete.php                      Suppression tâche
│   │   └── task-card.php                   Composant carte Kanban
│   └── index.php                           Page d'accueil
├── src/
│   ├── auth/
│   │   └── auth-middleware.php             Protection pages
│   ├── classes/
│   │   ├── Auth/
│   │   │   ├── User.php                    Modèle utilisateur
│   │   │   ├── UserManager.php             Gestion CRUD users
│   │   ├── PHPMailer/
│   │   ├── Tasks/
│   │   │   ├── Task.php                    Modèle tâche
│   │   │   ├── TaskInterface.php           Interface
│   │   │   └── TasksManager.php            Gestion CRUD tâches
│   │   │   └── TasksManagerInterface.php   Interface
│   │   ├── Database.php                    Connexion BDD
│   │   └── DatabaseInterface.php           Interface
│   ├── config/
│   │   ├── database.ini                    Config BDD
│   │   └── mail.ini                        Config email
│   ├── i18n/
│   │   ├── Translations/
│   │   │   ├── fr.php                      Traductions FR
│   │   │   ├── en.php                      Traductions EN
│   │   └── load-translation.php            Système i18n
│   └── utils/
│       └── autoloader.php                  Chargement classes

```

---

## Conformité aux contraintes

### Respect du cahier des charges et des contraintes techniques

- [x]  Application développée en **PHP natif (PHP 8+)**, sans utilisation de frameworks applicatifs externes (Laravel, Symfony, etc.)
- [x]  Utilisation d’une **base de données relationnelle MySQL/MariaDB**
- [x]  **Architecture entièrement orientée objet (POO)**, avec séparation claire des responsabilités
- [x]  Chargement automatique des classes via un **autoloader** conforme aux bonnes pratiques
- [x]  Utilisation de **namespaces** pour organiser le code (`Auth`, `Tasks`, etc.)
- [x]  Informations de connexion à la base de données stockées dans un **fichier de configuration externe** (`.ini`)
- [x]  Application **entièrement typée**
- [x]  Application **déployée sur Internet** et accessible publiquement via une URL fonctionnelle
- [x]  Respect du cahier des charges initial validé par le corps enseignant

---

### Fonctionnalités exigées par la grille d’évaluation

- [x]  Présence d’au moins **deux pages publiques** (accueil, inscription, connexion)
- [x]  Présence de **plus de quatre pages privées** accessibles uniquement après authentification
- [x]  Page d’accueil permettant de **comprendre immédiatement l’objectif de la plateforme** et d’accéder aux fonctionnalités principales
- [x]  Formulaire d’inscription avec **création de compte utilisateur**
- [x]  Envoi d’un **email de confirmation lors de la création d’un compte** (PHPMailer)
- [x]  Formulaire de connexion sécurisé (email ou nom d’utilisateur)
- [x]  **Gestion des sessions** permettant de maintenir l’utilisateur connecté
- [x]  Fonctionnalité de **déconnexion**
- [x]  Gestion d’au moins **deux rôles utilisateurs** (utilisateur standard / administrateur)
- [x]  **Contrôle des accès** aux pages et aux actions en fonction du rôle
- [x]  Gestion d’au moins **deux domaines métier liés** (utilisateurs ↔ tâches)
- [x]  Interface **multilingue (français / anglais)** avec gestion de la langue via **cookie**, conformément au jalon 4

---

### Bonnes pratiques issues de ProgServ1

- [x]  Validation des données côté serveur (formats, champs requis, cohérence des valeurs)
- [x]  Nettoyage systématique des saisies utilisateur (`trim`, filtrage, validation)
- [x]  Protection contre les **injections SQL** via l’utilisation exclusive de **requêtes préparées (PDO)**
- [x]  Protection contre les **attaques XSS** par l’échappement systématique des données affichées (`htmlspecialchars`)
- [x]  Code structuré, lisible, explicite et commenté lorsque nécessaire
- [x]  Séparation claire entre la logique métier, l’accès aux données et l’affichage

---

### Sécurité et gestion des accès

- [x]  Stockage sécurisé des mots de passe avec `password_hash()` et vérification via `password_verify()`
- [x]  Utilisation de **sessions PHP sécurisées** pour l’authentification
- [x]  Middleware d’authentification empêchant l’accès aux pages privées sans connexion
- [x]  **Isolation stricte des données** : chaque utilisateur n’accède qu’à ses propres tâches (`user_id`)
- [x]  Vérification systématique des autorisations avant toute modification ou suppression de données
- [x]  Protection contre les actions non autorisées, y compris pour les comptes administrateurs (ex. auto-modification)

---

## Technologies utilisées

### Backend

- **PHP 8+** : Langage serveur
- **MySQL/MariaDB** : Base de données relationnelle
- **PDO** : Abstraction base de données avec requêtes préparées
- **PHPMailer** : Envoi d'emails (inscription)

### Frontend

- **HTML5** : Structure sémantique
- **CSS** : Styling moderne avec Classless.css
- **JavaScript** : Interactions (AJAX, changement de vue)
- **Responsive Design** : Adaptation mobile/desktop

### Architecture

- **POO** : Programmation orientée objet
- **Autoloader** : Chargement automatique des classes
- **Namespace** : Organisation du code (Tasks, Auth)
- **Sessions PHP** : Gestion de l'authentification
- **i18n** : Internationalisation (FR/EN)

---

## Répartition des tâches

### Luca Leone

**Domaine : Backend, Authentification & Sécurité**

Responsable de la logique métier, de la persistance des données et de la sécurité globale de l’application.

- Conception et implémentation du **système de gestion des tâches (CRUD complet)**
- Modélisation de la **base de données** et mise en place des relations (users ↔ tasks)
- Mise en place de l’**architecture backend orientée objet**
- Implémentation de l’**autoloader** et organisation du code via **namespaces**
- Développement du **système d’authentification** (inscription, connexion, déconnexion)
- Création des classes **User** et **UserManager**
- Gestion des **sessions** et maintien de l’état connecté
- Mise en place du **middleware d’authentification** pour la protection des pages privées
- Gestion des **rôles utilisateurs** (utilisateur / administrateur)
- Développement de la **page d’administration des utilisateurs**
- Configuration de l’**envoi d’emails transactionnels** (confirmation de création de compte)
- Développement de la **vue Kanban à 3 colonnes** (À faire / En cours / Terminé)
- Développement du **système multilingue (FR / EN)** avec stockage de la langue dans un cookie

---

### Sacha Loskov

**Domaine : Architecture applicative & Programmation orientée objet**

Responsable de la structure globale du projet, de la cohérence POO et de l’identité visuelle de base.

- Mise en place de l’**architecture générale de l’application**
- Définition des **bonnes pratiques POO** utilisées dans le projet
- Contribution à la conception des **modèles métier** (Task, TasksManager)
- Vérification de la **cohérence des responsabilités** entre classes
- Participation à la structuration du backend (séparation logique métier / affichage)
- Création du **logo** et du **favicon**
- Mise en place initiale du **système de traduction**
- Contribution à la lisibilité et à la maintenabilité du code

---

### Ryad Ait-Slimane

**Domaine : Déploiement, Configuration & Mise en production**

Responsable de la mise en ligne de l’application et de la configuration de l’environnement de production.

- Prise et gestion du **nom de domaine**
- Configuration de l’**hébergement Infomaniak**
- Mise en place de l’environnement de production (PHP, base de données MySQL/MariaDB)
- Déploiement de l’application web sur Internet
- Configuration des **paramètres serveur** nécessaires au bon fonctionnement de l’application
- Mise en place et configuration du **service d’envoi d’emails** (SMTP)
- Tests de bon fonctionnement en environnement de production (authentification, emails, accès aux pages privées)

---

## Points forts du projet

### 🎨 Interface moderne

- Vue Kanban intuitive avec 3 colonnes
- Cartes de tâches avec couleurs selon priorité
- Changement de statut rapide sans rechargement
- Animations et transitions fluides

### 🔐 Sécurité robuste

- Protection contre SQL injection (PDO)
- Protection contre XSS (échappement)
- Hashage sécurisé des mots de passe
- Isolation des données par utilisateur
- Middleware d'authentification

### 🌍 Multilingue

- Système de traduction complet
- Sélection dynamique de la langue
- Mémorisation de la préférence
- Support FR/EN extensible

### 📱 Responsive

- S'adapte à tous les écrans
- Interface mobile-friendly
- Vue Kanban adaptative

### 🏗️ Architecture propre

- Code orienté objet
- Séparation des responsabilités
- Réutilisabilité (task-card.php)
- Autoloader efficace

---

## Conclusion

Le projet **TaskBoard** répond aux exigences du cahier des charges avec :

- ✅ Une application web fonctionnelle et sécurisée
- ✅ Un système complet de gestion de tâches
- ✅ Une authentification robuste avec gestion des rôles
- ✅ Une interface moderne en mode Kanban
- ✅ Un système multilingue (FR/EN)
- ✅ Une architecture POO propre et maintenable
- ✅ Le respect des bonnes pratiques de sécurité

---

## Sources et références

### Bibliothèques utilisées

- **Classless.css** : Framework CSS minimaliste pour le design
    - https://classless.de/
- **PHPMailer** : Bibliothèque d'envoi d'emails
    - https://github.com/PHPMailer/PHPMailer

### Assistance IA

- **Claude (Anthropic)** : Utilisé pour :
    - Générer le composant Kanban moderne
    - Créer le système de traduction i18n
    - Debugging et résolution de problèmes techniques
    - Structuration du code POO

### Inspirations

- Interface Kanban inspirée de **Trello** et **Notion**
- Code disponible sur le Github :
    - https://github.com/heig-vd-progserv-course/heig-vd-progserv2-course#heig-vd-progserv2-course

---

**Date de dernière mise à jour :** 17 décembre 2025
