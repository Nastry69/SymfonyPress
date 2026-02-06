# SymfonyPress

SymfonyPress est un mini CMS développé avec **Symfony 8**, conçu comme un projet pédagogique structuré mais avec une approche réaliste proche d’une application de production.

Il permet de consulter des articles, de les organiser par catégories, et de les administrer via un back-office sécurisé avec gestion des utilisateurs et upload d’images.

---

## Fonctionnalités

### Front-office (public)
- Page d’accueil avec liste d’articles
- Affichage des catégories sous forme de tags
- Consultation d’un article via son slug
- Pages catégories listant les articles associés

### Back-office (sécurisé)
- Authentification (inscription / connexion / déconnexion)
- CRUD complet des articles
- Association article ↔ catégorie
- Upload d’une image de couverture
- Accès protégé aux routes `/admin`

---

## Stack technique

- PHP 8.2+
- Symfony 8
- Doctrine ORM
- Twig
- MySQL / MariaDB
- Asset Mapper (sans Node obligatoire)
- Sécurité Symfony (firewall, authenticator)

---

## Prérequis

- PHP ≥ 8.2
- Composer
- MySQL ou MariaDB
- Symfony CLI (recommandé)
- Git

---

## Installation

### 1. Cloner le projet

```bash
git clone <URL_DU_REPO>
cd symfonypress 

---

### 2. Installer les dépendances
composer install

---

### 3. Configuration de l’environnement

Créer un fichier .env à partir du fichier .env.exemple 

Créer ensuite un fichier .env.test : 

KERNEL_CLASS='App\Kernel'
APP_SECRET='$ecretf0rt3st'


Configurer ensuite la variable DATABASE_URL dans .env :

DATABASE_URL="mysql://user:password@127.0.0.1:3306/symfonypress?serverVersion=8.0"
DATABASE_URL="mysql://user:password@127.0.0.1:3306/symfonypress?serverVersion=10.4.32-MariaDB&charset=utf8mb4"
DATABASE_URL="postgresql://user:password@127.0.0.1:5432/symfonypress?serverVersion=16&charset=utf8"


Paramètres à adapter :

user : utilisateur MySQL/POSTGRES

password : mot de passe MySQL/POSTGRES

symfonypress : nom de la base de données

---

### 4. Initialisation de la base de données

Créer la base de données :

symfony console doctrine:database:create


Exécuter les migrations :

symfony console doctrine:migrations:migrate

Importer la Base de données depuis le dossier BDD

---

### 5. Lancer l’application

Avec Symfony CLI (recommandé) :

symfony serve:start

Ou avec PHP :

php -S 127.0.0.1:8000 -t public

Si il y a une erreur vérifier dans le dossier confi/packages/webpack_encore.yaml et remplace le build par assets

Comptes utilisateurs (démo)

La base de données a été recréée avec de nouveaux utilisateurs.

Administrateur : 
    Email : admin@exemple.fr

    Mot de passe : Test123!

    Rôle : ROLE_ADMIN

USER 1 :
    Email : user@gmail.com

    Mot de passe : Test123456@

    Rôle : ROLE_USER



USER 2 :
    Email : user2@exemple.com

    Mot de passe : TestTest@

    Rôle : ROLE_USER


Ces comptes permettent :

    - de créer et modifier des articles

    - d’ajouter une image de couverture

    - de visualiser le rendu côté front

---

## Routes principales
Front-office
Page	URL
Accueil	/
Article	/article/{slug}
Catégorie	/category/{slug}
Back-office (protégé)
Action	URL
Liste des articles	/admin/article
Création	/admin/article/new
Édition	/admin/article/{id}/edit
Suppression	/admin/article/{id}

---

## Gestion des images

Upload via le formulaire d’administration
Stockage des fichiers dans public/uploads/
Nom du fichier enregistré en base
Affichage optimisé :
loading="lazy"
attribut alt descriptif
dimensions définies

---

## Sécurité

Authentification par formulaire

Mots de passe hashés

Accès /admin restreint aux utilisateurs connectés

Hiérarchie des rôles :

ROLE_ADMIN > ROLE_USER

---

## Architecture
src/
├── Controller/
│   ├── Admin/
│   ├── ArticleController.php
│   ├── CategoryController.php
│   └── HomeController.php
├── Entity/
├── Repository/
├── Security/
templates/
├── base.html.twig
├── layout/
├── pages/
├── components/



Ce projet est distribué sous licence MIT.
Voir le fichier LICENSE.


    Amusez vous bien !