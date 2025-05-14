<?php

    // Inclusion du fichier de connexion à la base de données
    include '../includes/connexion.php';

    // Vérification si le formulaire a été soumis en vérifiant si 'ok' est présent dans les données POST
    if (isset($_POST['ok'])) {
        // Vérification si les champs nécessaires sont remplis dans le formulaire
        if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        
            // Récupérer les valeurs envoyées dans le formulaire et appliquer htmlspecialchars pour prévenir les attaques XSS
            $username = htmlspecialchars($_POST["username"]);  // Appliquer htmlspecialchars pour sécuriser les entrées utilisateur
            $email = htmlspecialchars($_POST["email"]);  // Sécuriser l'email de l'utilisateur
            $password = $_POST["password"];  // Le mot de passe ne doit pas être modifié par htmlspecialchars (la sécurité sera gérée plus tard)

            // Hachage du mot de passe avec l'algorithme PASSWORD_DEFAULT (génère un hash sécurisé)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Préparer la requête SQL pour insérer un nouvel utilisateur dans la base de données
            try {
                // Préparer la requête d'insertion avec des paramètres liés pour éviter les injections SQL
                $requete = $bdd->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
            
                // Exécuter la requête en passant les données de l'utilisateur
                $requete->execute([
                    'username' => $username,  // Passer le nom d'utilisateur
                    'email' => $email,  // Passer l'email
                    'password' => $hashed_password  // Passer le mot de passe haché
                ]);

                // Si l'insertion réussit, rediriger l'utilisateur vers la page de connexion
                header("Location: connexion.php");  // Rediriger vers la page de connexion
                exit();  // Arrêter l'exécution du script après la redirection

            } 
            catch (PDOException $e) {
                // Si une erreur survient (par exemple, une erreur de base de données), afficher un message d'erreur
                echo "Erreur lors de l'inscription : " . $e->getMessage();  // Afficher l'erreur liée à la base de données
            }
        } 
        else {
            // Si un ou plusieurs champs sont vides, afficher un message d'erreur
            echo "Tous les champs sont obligatoires.";  // Message d'erreur si des champs sont vides
        }
    } 
    else {
        // Si le formulaire n'a pas été soumis, afficher un message d'erreur
        echo "Formulaire non soumis.";  // Message d'erreur si le formulaire n'a pas été soumis correctement
    }

?>
