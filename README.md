E-commerce
==========

Projet du cours de projet développement web.

Installation
------------

- Cloner le répertoire.
- Installer un serveur mysql, créer une db et restorer le fichier `dump.sql`.
- Editer le fichier `app/config.php` avec les informations db et éventuellement le titre du projet.
- Installer un serveur apache avec php et le lancer.
- Préparer un vhost (et éventuellement un host) pointant sur la racine du répertoire.
- Donner accès en écriture sur le dossier `downloads` à votre utilisateur apache.

Fonctionnement
--------------

La première fois que vous allez accéder à l'application web depuis votre navigateur, un utilisateur "admin" sera créé avec comme mot de passe "admin" (n'oubliez pas de changer le mot de passe par la suite).

Une fois connecté en tant qu'admin, vous aurez la possibilité via le menu Administration de:
- Gérer les utilisateurs (éditer/supprimer)
- Ajouter un utilisateur
- Gérer les articles (éditer/supprimer)
- Ajouter un article
- Gérer les commandes (voir le détail, valider ou annuler)
- Visualiser les statistiques

Une fois que vous disposez d'au moins un article, les utilisateurs "client" pourront alors alimenter leur panier et confirmer des commandes.
