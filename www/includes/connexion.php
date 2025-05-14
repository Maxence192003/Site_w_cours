<?php
    // Connexion à la base de données
    $servername = "mysql";  // L'adresse du serveur MySQL (ici, "mysql" indique qu'il est en local ou sur un serveur Docker)
    $username = "root";     // Nom d'utilisateur pour la connexion (ici, "root" pour l'administrateur par défaut)
    $password = "root";     // Mot de passe pour la connexion (ici, "root" comme mot de passe par défaut)

    try {
        // Tentative de création d'une nouvelle instance PDO pour se connecter à la base de données
        // PDO prend 3 arguments : le DSN (Data Source Name), le nom d'utilisateur, et le mot de passe
        // DSN spécifie le type de base de données, l'hôte, et le nom de la base de données
        $bdd = new PDO("mysql:host=$servername;dbname=test_db", $username, $password);
    
        // Configurer PDO pour lever des exceptions en cas d'erreur
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } 
    catch (PDOException $e) {
        // En cas d'échec de la connexion, capturer l'exception et afficher un message d'erreur
        echo "Erreur de connexion : " . $e->getMessage();
    
        // Terminer l'exécution du script si la connexion échoue
        die();
    }
?>
