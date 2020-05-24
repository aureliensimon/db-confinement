# DB CONFINEMENT

db confinement est une application permettant de générer automatiquement des données Ces données seront accessibles selon différents formats (fichier csv, fichier SQL, table de bdd) afin d’être exploitées dans différents contextes.

## Installation

#### Base de données

Créer une base de donnée sous mysql.
Depuis un terminal ou phpmyadmin, lancer le script sql nommé script.sql à la racine du dossier

#### Droits sur les fichiers

Le script bash install va donner les droits nécessaires à certains fichier php afin de pouvoir télécharger des fichier.

Pour celà il faut donner les droits d'executions au fichier bash puis l'executer
```
$ > chmod +x install.sh
$ > ./install.sh
```
