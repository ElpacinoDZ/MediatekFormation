# Mediatekformation
## Présentation
Ce site, développé avec Symfony 5.4, permet d'accéder aux vidéos d'auto-formation proposées par une chaîne de médiathèques et qui sont aussi accessibles sur YouTube.<br> 

## Les différentes pages
Voici les 5 pages correspondant aux différents cas d’utilisation.
### Page 1 : la page des formations
La partie des formations permet de lister les différentes formations. Il est possible d'ajouter, modifier ou même supprimer une formation. Il est également possible de filtrer les formations<br>
![img2](https://github.com/squareface27/mediatekformation/blob/prod/images/admin_formations.png?raw=true)
### Page 2 : la page d'ajout de formations
Cette page permet d'ajouter de nouvelles formations au catalogue. Tout les champs sont obligatoires, sauf le champ de titre et le champ de catégorie.
![img3](https://github.com/squareface27/mediatekformation/blob/prod/images/admin_formations_add.png?raw=true)
### Page 3 : la page des playlists
Cette page permet de lister les différentes playlists, de voir leur nom, la catégorie et aussi le nombre de vidéos associées à cette playlist. Les playlists peuvent être filtrées, il est également possible de modifier une playlist, d'en supprimer une si celle-ci ne contient aucune formation associée ou d'ajouter une nouvelle playlist.
![img4](https://github.com/squareface27/mediatekformation/blob/prod/images/admin_playlists.png?raw=true)
### Page 4 : la page d'ajout de playlist
Cette page permet d'ajouter une nouvelle playlist.Le nom de la playlist est obligatoire, la description est facultative
![img5](https://github.com/squareface27/mediatekformation/blob/prod/images/admin_playlists_add.png?raw=true)
### Page 5 : La page des catégories
Cette page permet de lister les catégories, on peut y trouver le nombre de vidéos liée à la catégorie. Il est possible de trier les catégories par nom. Il est possible d'ajouter une catégorie en indiquant le nom en haut à gauche. Il est également possible de supprimer une catégorie si celle-ci ne contient aucune formation.
![img6](https://github.com/squareface27/mediatekformation/blob/prod/images/admin_categories.png?raw=true)


- Vérifier que Composer, Git et Wamserver (ou équivalent) sont installés sur l'ordinateur.
- Télécharger le code et le dézipper dans www de Wampserver (ou dossier équivalent) puis renommer le dossier en "mediatekformation".<br>
- Ouvrir une fenêtre de commandes en mode admin, se positionner dans le dossier du projet et taper "composer install" pour reconstituer le dossier vendor.<br>
- Récupérer le fichier mediatekformation.sql en racine du projet et l'utiliser pour créer la BDD MySQL "mediatekformation" en root sans pwd (si vous voulez mettre un login/pwd d'accès, il faut le préciser dans le fichier ".env" en racine du projet).<br>
- De préférence, ouvrir l'application dans un IDE professionnel. L'adresse pour la lancer est : http://localhost/mediatekformation/public/index.php<br>
- Installer OpenJDK<br>
    - Pour cela, ouvrir le navigateur et aller sur le site de openjdk :
https://openjdk.java.net/
Dans la nouvelle page, paragraphe “Download”, cliquer sur le lien “jdk.java.net/18”.
Dans la nouvelle page, partie “Builds”, cliquez sur “zip” à côté de “Windows/x64”.
Une fois le fichier téléchargé, aller dans Donwloads, clic droit sur le fichier, “Extract all” et choisir comme emplacement “C:\” puis “Extract”.
En racine de C, le dossier “jdk-18.×.x” a été créé.
Dans les variables d’environnement système :
        - Dans la variable path, ajouter le chemin vers le dossier bin du jdk (du genre “C:\jdk-18.×.x\bin”).
        - Créer la variable “JAVA_HOME” et mettre le chemin vers le dossier du jdk (le dossier racine, donc du genre “C:\jdk-18.×.x”).
        Enregistrer.


