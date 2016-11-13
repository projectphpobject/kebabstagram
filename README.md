##Installation

#Vhost
Ajouter le virtualhost sur apache ou sur wampserver (kebabstagram.conf)

#le site est accessible via l'url: http://localhost/kebabstagram/public/

#un dossier de photos est automatiquement créé lors de la première insertion d'un kebab (dans public/uploads/)

#Mysql
Les scripts de base de données se trouve dans le dossier 'base'. Il y a un script pour créer la base et un script donnees.sql qui permet d'insérer quelques données pour utiliser l'application,  comme des catégories ainsi qu'une clé pour utiliser l'api.

#Connexion à la base
le fichier config.ini contient les paramètres les paramètres de connexion à la base de données.