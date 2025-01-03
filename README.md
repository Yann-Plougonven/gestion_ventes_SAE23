# Gestion des ventes SAE23
Ce site web a été réalisé dans le cadre d'une Situation d'Apprentissage et d'Évaluation (SAE23) proposée par mes enseignants durant mon second semestre de BUT Réseaux et Télécommunications.

Il permet de gérer, à l'aide d'une interface intuitive, la base de données des ventes, clients et produits d'un magasin fictif.

## Consulter le projet
### Accéder au site web
**Information importante :** La base de données du site publié en ligne étant modifiable par tous, elle est susceptible de contenir des éléments inappropriés. Privilégiez la consultation des données hebergées sur GitHub.

➡️ Vous pouvez télécharger ce repository sur votre ordinateur, et le consulter en l'hébergeant en local à l'aide du logiciel XAMPP.

Le site web est également consultable en ligne à l'adresse suivante : https://sae23web.azurewebsites.net

### Identifiants de connexion au site web
Les identifiants d'utilisateurs fictifs sont inclus dans la base de données.
* superuser@test.fr:L@nnion est un admin ayant un accès total au site web.
* simpleuser@test.fr:L@nnion est un vendeur ayant a un accès réduit au site web.
* thomas@test.fr:L@nnion est un client n'ayant accès qu'à la consultation des produits vendus.

## Fonctionnalités du site web
Les fonctionnalités implémentées sont parfois incomplètes ou absurdes, car ce projet devait respecter certaines contraines très précises dans le cadre de l'évaluation de nos compétences.

Parmi les fonctionnalités implémentées :
* Page de connexion
  * Vérification en local (javascript) de bon respect des critères de sécurité du mot de passe (longueur, caractère spéciaux...)
  * Création de session
  * Vérification du statut de l'utilisateur (admin, vendeur, client)
  * Enregistrement de la tentative de connexion dans des logs
* Affichage des informations de la base de données, parfois en utilisant AJAX (modification de la page sans l'actualiser)
* Formulaires dynamiques (pré-remplissage et pré-tri des données selon les réponses renseignées par l'utilisateur dans les premiers champs)
  * Insertion d'informations dans la base de données avec AJAX
  * Modification d'informations de la base de données avec AJAX
  * Suppression d'informations de la base de données avec AJAX
  * Génération de Captchas
* Mise en forme avec le Framework Bootstrap
