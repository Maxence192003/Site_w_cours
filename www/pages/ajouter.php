<?php
    session_start(); // Démarre la session pour accéder aux variables de session. Cela permet de récupérer des informations sur l'utilisateur qui est connecté (par exemple, son nom d'utilisateur).
 
    // Vérifier si l'utilisateur est connecté
    if (isset($_SESSION['username'])) {
        // Si la variable de session 'username' est définie, cela signifie que l'utilisateur est connecté.
        $username = htmlspecialchars($_SESSION['username']); // Sécuriser la sortie pour éviter les attaques XSS (Cross-Site Scripting). Cette fonction convertit les caractères spéciaux en entités HTML.
        echo "Bonjour, " . $username . " ! Bienvenue sur la page Admin."; // Affiche un message de bienvenue avec le nom de l'utilisateur.
    } 
    else {
        // Si l'utilisateur n'est pas connecté, afficher un message indiquant qu'il doit se connecter.
        echo "Vous devez vous connecter pour accéder à cette page.";
        echo '<br><a href="connexion.php">Se connecter</a>'; // Affiche un lien vers la page de connexion pour permettre à l'utilisateur de se connecter.
        exit();
    }
?>
<html lang="fr"> <!-- Définit la langue de la page comme étant le français. -->
<head>
    <meta charset="UTF-8"> <!-- Définit l'encodage des caractères (UTF-8) pour s'assurer que tous les caractères spéciaux sont correctement affichés. -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Rend la page responsive pour qu'elle s'adapte à différentes tailles d'écran (par exemple, mobile et bureau). -->
    <title>Ajouter un Livre</title> <!-- Titre de la page, affiché dans l'onglet du navigateur. -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <h2>Ajouter un Livre</h2> <!-- Titre principal de la page (section d'ajout de livre). -->

    <!-- Formulaire pour ajouter un livre -->
    <form method="POST" action="traitement_biblio.php" enctype="multipart/form-data">
        <!-- Le formulaire envoie les données à 'traitement_biblio.php' via la méthode POST. -->
        <!-- L'attribut 'enctype="multipart/form-data"' est nécessaire si des fichiers sont envoyés (par exemple, une image). -->

        <label for="Titre">Titre</label> <!-- Étiquette pour le champ du titre du livre. -->
        <input type="text" id="Titre" name="Titre" required> <!-- Champ pour entrer le titre du livre. 'required' signifie que ce champ est obligatoire. -->
        <br> <!-- Saut de ligne pour espacer les éléments. -->

        <label for="Auteur">Auteur</label>
        <input type="text" id="Auteur" name="Auteur" required>
        <br>

        <label for="Bio">Biographie</label>
        <input type="text" id="Bio" name="Bio" required>
        <br>

        <label for="Desc">Description</label>
        <input type="text" id="Desc" name="Desc" required>
        <br>

        <label for="image">Image (facultatif)</label> 
        <input type="file" id="image" name="image" accept="image/*">
        <br>

        <!-- Boutons du formulaire -->
        <button type="submit" name="okay">Ajouter</button> <!-- Bouton pour soumettre le formulaire et ajouter un livre. Le nom 'okay' peut être utilisé pour traiter la demande dans le backend. -->
        <button type="button" onclick="window.location.href='Admin.php'">Annuler</button> <!-- Bouton qui annule l'ajout et redirige l'utilisateur vers la page d'accueil (index.php). -->
    </form>

</body>
</html>
