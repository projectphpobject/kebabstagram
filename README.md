##Installation

#Vhost
Ajouter le virtualhost sur apache ou sur wampserver (kebabstagram.conf)

#le site est accessible via l'url: http://localhost/kebabstagram/public/

#un dossier de photos est automatiquement créé lors de la première insertion d'un kebab (dans public/uploads/) (note importante: il faut que l'utilisateur dispose des droits sur le dossier sinon le dossier ne sera pas créé, si le dossier est créé déjà il vaut mieux le supprimer et relancer le site)

#Mysql
Les scripts de base de données se trouve dans le dossier 'base'. Il y a un script pour créer la base .

#Connexion à la base
le fichier config.ini contient les paramètres les paramètres de connexion à la base de données.

#mode d'utilisation:
-POUR AJOUTER UN KEBAB: il faut être inscrit et connecté. Une fois connecté dans la barre de navigation: ajouter kebab, il faut ensuite renseigner les champs nécesssaires: mot de passe (confirmation), titre, description, image à sélectionner.

-POUR AJOUTER UN COMMENTAIRE: sur la liste des kebabs affichés, sur le lien commenter: on peut saisir un commentaire avec des tags (#tag): exemple:

"ceci est un exemple de commentaire avec des #tags et d'autres #tags"; les tags s'afficheront dans la page d'acceuil;

-AJOUTER UN TAG: on peut ajouter un tag directement (ou plusieurs tags), en cliquant sur le lien: ajouter tag, on saisit ensuite le tag (ou les tags avec #)

-On peut noter une photo (une seule fois ), en cliquant sur les étoiles (la note est de note/5): exemple 3.8/5.
Une fois la note enregistrée un calcul se fera pour afficher la note finale de la photo ciblée.

-On peut afficher les kebabs d'un utilisateur connecté: en cliquant sur "Mes kebabs", dans la barre de navigation;

-Les recherches: on peut effectuer des recherches par : -utilisateur : en choisissant la catégorie de recherche: par utlisateur, ensuite en saisissant "nom ou prénom" dans le champ à côté "tapez votre tag"
                                                        -tag: en sélectionnant recherche par tag: saisir le tag: soit avec # ou sans #;
                                                        -mot-clé: saisir le mot-clé, ce qui aura pour effet de chercher le mot saisi soit dans le titre du kebab ou de sa description;
                                                        -ville: on peut effectuer une recherche par lieu, en saisissant: la ville du kebab dans le champ : ville (pour l'instant les départements ne fonctionnent pas)
                                                        -ON peut également saisir une recherche quelconque dans : recherche: mot-clé, tag ou utilisateur, dans le champ: Recherche
                                                        