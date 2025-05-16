<?php
    session_start(); // Démarre une session PHP pour suivre l'état de l'utilisateur entre différentes pages.

    // Inclure le fichier de connexion à la base de données.
    include '../includes/connexion.php';

    // Vérifie si le formulaire a été soumis via la méthode POST.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Récupérer les données du formulaire.
        $email = $_POST["email"];
        $password = $_POST["password"];
    
        // Vérifier que les champs ne sont pas vides.
        if (!empty($email) && !empty($password)) {
            // Préparer une requête pour récupérer le nom d'utilisateur, le mot de passe haché et le rôle.
            $req = $bdd->prepare("SELECT username, password, role FROM users WHERE email = :email");
            $req->execute(['email' => $email]);
            $user = $req->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                $hashed_password = $user['password'];
                $role = $user['role'];

                // Vérifier le mot de passe
                if (password_verify($password, $hashed_password)) {
                    // Vérifier que l'utilisateur est un administrateur
                    if ($role === 'A') {
                        $_SESSION['username'] = $user['username'];
                        header("Location: Admin.php");
                        exit();
                    } else {
                        // Redirection si le rôle n'est pas 'A'
                        header("Location: ../index.php");
                        exit();
                    }
                }
            }

            // Message d'erreur générique
            $erreur = "Email ou mot de passe incorrect !";
        } else {
            $erreur = "Veuillez remplir tous les champs.";
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body id=form_b>
    <div id="form_d">
        <h1>Connexion</h1>

        <form method="POST" action="">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            <br>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password" required>
            <br>

            <button type="submit">Se connecter</button>
            <button type="button" onclick="window.location.href='../index.php'">Annuler</button>
        </form>
    </div>
    <?php if (!empty($erreur)) { echo "<p style='color:red;'>$erreur</p>"; } ?>
</body>
</html>
