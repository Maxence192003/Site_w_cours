# 🌐 Site Web - Cours SIO en Docker (CRUD PHP)

Ce projet est une application web développée dans le cadre de la première année du BTS SIO. Il s'agit d'un site web PHP fonctionnant avec Docker, permettant de gérer des données via un système CRUD (Create, Read, Update, Delete).

## 🛠 Fonctionnalités

- 🔐 Système d'inscription et de connexion utilisateur
- ➕ Ajout de données (Create)
- 📄 Consultation des données (Read)
- ✏️ Modification des données (Update)
- ❌ Suppression des données (Delete)
- 👤 Interface administrateur (Admin.php)

## ⚙️ Technologies utilisées

- PHP
- HTML / CSS
- MySQL (via Docker)
- Docker & Docker Compose

## 📁 Arborescence principale

```
.
├── BDD/                    # Scripts SQL (base de données)
├── www/                    # Code source principal (PHP)
│   ├── index.php
│   ├── pages/
│     ├── inscription.php
│     ├── connexion.php
│     ├── ajouter.php
│     ├── lire.php
│     ├── modifier.php
│     ├── suprime.php
│     ├── Admin.php
│     ├── traitement.php
│     └── traitement_biblio.php
│   ├── includes/
│     ├── connexion.php
│     └── deconnexion.php
│   ├── assets/
│     ├── css/
│        └── style.css
│     ├── img/
└── README.md
```

## 🚀 Lancer le projet avec Docker

1. Cloner le dépôt :
   ```bash
   git clone https://github.com/Maxence192003/Site_w_cours.git
   cd Site_w_cours
   ```

2. Lancer Docker :
   ```bash
   docker-compose up -d
   ```

3. Accéder au site et la BDD :
   Ouvrez votre navigateur à l'adresse http://localhost:8080/www/index.php pour le site web
   Ouvrez votre navigateur à l'adresse http://localhost:8081/ pour le site web
   ├── Username: root
   └── Password: root

4. Ajouter la BDD d'exemple dans la BDD local:
   Il faudrat juste faire un import

## Note:
1. Pour pouvoir accéder au CRUD il faudrat ce connecter et ajouter un rôle A (correspond au admin) dans la table users  dans la BBD.
   Commande a taper: Il faudrat mettre l'id de la personne a qui vous voulez ajouter le role
   UPDATE users
   SET role = 'A'
   WHERE id = ;
