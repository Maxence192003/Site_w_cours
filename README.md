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

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/Maxence192003/Site_w_cours.git
   cd Site_w_cours
   ```

2. **Lancer Docker :**
   ```bash
   docker-compose up -d
   ```

3. **Accéder à l'application et à la base de données :**

   - Site web : http://localhost:8080/www/index.php
   - PhpMyAdmin : http://localhost:8081
     ```
     ├── Username: root
     └── Password: root
     ```

4. **Importer la base de données :**

   - Depuis PhpMyAdmin, importer le fichier SQL présent dans le dossier `BDD/`.

---

## 🔐 Accès à l'administration

Pour accéder aux fonctionnalités d'administration du CRUD :

1. Connectez-vous avec le compte root.
2. Dans la table `users`, attribuez le rôle `A` à l'utilisateur souhaité :

   ```sql
   UPDATE users
   SET role = 'A'
   WHERE id = <ID_UTILISATEUR>;
   ```
