# PHP EVAL

Présentation de mon TP pour l'évaluation des connaissances en PHP.

## Installation

Nécessiter d'utiliser les commandes suivantes dans le terminal:
composer global require symfony/var-dumper -> Pour installer le var-dumper en global
Composer install -> Pour installer l'ensemble des dépendances

Avoir mysql.server de lancé, et lancer mysql -uroot -p
Pour créer une base de données sur mysql et migrer les bases de données:
php bin/console/database-create.php
php bin/console/database-migrations-migrate.php 

## Usage

Petite web application d'un site e-commerce en frontend, un backend et une BDD.

Possibilité d'ajouter, de supprimer, d'updater voire lire les données. 
Le site web devra être prémuni contre les attaques de XSS et Injection SQL.
Le site est une boutique en ligne.
Tous les utilisateurs peuvent mettre en vente des produits, ou en acheter. 

Le site contient:
- Page d’accueil: Liste des produits mis en vente, Un produit est affiché avec un titre et un prix
- Gestion utilisateur: Création de compte (identifiant de compte: email et doit être unique), Connexion, Déconnexion, Profile - Modification des informations,Section produit
- Création produit: Titre et prix seulement
- Page de modification d’un produit (uniquement par la personne ayant creer le produit)
- retrait de la vente du produit (uniquement par la personne ayant creer le produit)

## Contributing
Mathieu C.
