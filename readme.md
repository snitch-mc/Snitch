
![App Screenshot](https://i.imgur.com/ZxFKJ3M.png)
# Snitch

Je joue à Minecraft depuis 2013, et depuis le premier jour je créé des serveurs pour mes amis ou pour des gens que je ne connais pas. J’ai tout de suite adoré ce jeu et son univers, mais une chose revenait trop régulièrement et me déplaisait vraiment : **les mauvais joueurs**

Il existe plusieurs manières de s’en débarrasser, comme le bannissement, le kick, le ban-ip, etc. mais pourquoi ne pas couper le problème à la racine et s’en débarrasser par défaut ?

**Snitch répertorie tous les signalements faits par des administrateurs ou modérateurs de serveur dans une base de données et permet aux serveurs s’en servant de chercher si un utilisateur suspect a déjà été dénoncé pour tricherie ou mauvais comportement sur d’autres serveurs.**

Notre but : une communauté Minecraft francophone sûre et agréable.
## Fonctionnalités

- Création de compte
- Photo de profil automatique liée au skin Minecraft
- Édition du profil utilisateur
- Dénoncer un utilisateur
- Trouver un UUID via un username
- Image isométrique de skin du joueur dénoncé
- Liste d'utilisateurs dénoncés
- Panel administrateur
- Mode maintenance
- Personnalisation du mode maintenance
- Mode sombre et clair
## Technologies utilisées

POO (Programmation Orientée Objet) et MVC

PHP, HTML, CSS, JavaScript et Base de données

API Externes
## Installation
Pour installer le CMS sur votre serveur, veuillez suivre ces instructions :

1. Copiez le projet GitHub dans la racine de votre site web.

2. Redirigez votre serveur PHP vers /public au chargement

3. Créez une nouvelle base de données en important le fichier SQL présent dans le projet ( /Core/snitch.sql )

4. Modifiez le fichier ( /Core/cred_example.php ) avec les bonnes données de connexion vers votre base de données puis renommez le fichier credentials.php
   Les informations de connexions par défaut sont dans le fichier d’exemple.

Le site fonctionne maintenant avec des utilisateurs factices et des posts factices. Vous pouvez importer une base de données vierge en prenant le fichier snitch_empty.sql au lieu de snitch.sql.

Pour vous connecter aux comptes factices, utilisez les deux premières lettres de chacun de leur email comme mot de passe et le tour est joué.
Après ça vous pouvez supprimer les deux fichiers SQL.

## Permissions

Il existe 4 niveaux d’utilisateurs qui confèrent certaines permissions ou non.

Pour modifier les accès selon les niveaux, vous devez modifier les Controllers.

### Administrateur [1]

Le premier niveau est l’administrateur ( permission = 1 ) qui peut tout faire sur le site.

-	Panel administrateur
-	Bypass maintenance
-	Signaler des joueurs
-	Voir les signalements
-	Gestion du profil
-	Accéder au site web

### Gérant de serveur [2]
Le deuxième niveau est le Gérant de serveur ( permission = 2 )

-	Signaler des joueurs
-	Voir les signalements
-	Gestion du profil
-	Accéder au site web

### Membre [3]
Le troisième niveau est le Membre ( permission = 3 )

-	Voir les signalements
-	Gestion du profil
-	Accéder au site web

### Visiteur [null]
Le dernier niveau est pour les visiteurs du site, non-inscrits

-	Accéder au site web
## API Externes

### PlayerDB

L'API la plus utile sur ce projet est PlayerDB, que nous contactons lorsqu'on recherche un UUID.

-> `public/js/main.js`
```javascript
var url = "https://playerdb.co/api/player/minecraft/" + username;

        var xhr = new XMLHttpRequest();
        xhr.open("GET", url);
```
Dans la réponse à cette requête, si l'utilisateur existe, on obtient entre autres son UUID.

### MC-Heads

Cette API nous permet d'avoir la tête du skin du compte connecté.

-> `Views/layout.php`
```php
src="https://mc-heads.net/avatar/<?php echo $user; ?>/100">
```

### Crafatar

Crafatar nous permet d'afficher le skin du joueur en isométrique dans la page Signaler et dans la page d'informations du signalement

-> `public/js/main.js`

```javascript
document.getElementById("report-left-player").setAttribute("src", "https://crafatar.com/renders/body/" + obj.data.player.id +"?overlay")
```
## Base de donnée

![Schéma de la base de données](https://i.imgur.com/mAeCvWX.png)
## Fonctionnalités futures

- Trouver un pseudo avec le UUID
- Plugin minecraft pour les serveurs
    - Permet de notifier un utilisateur lorsqu’un joueur déjà dénoncé rejoint le serveur
    - Permet de dénoncer un joueur directement depuis le serveur
    - Permissions avancées
- Fonction de recherche sur le site, pour trouver un utilisateur dénoncé
- Filtres pour voir les utilisateurs dénoncés selon certaines conditions
- Formulaire de réinitialisation de mot de passe
- Validation par courriel lors de l’inscription
