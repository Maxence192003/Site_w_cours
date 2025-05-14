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
<!DOCTYPE html>
    <html lang="fr">

    <head>
        <meta charset="UTF-8"> <!-- Définit l'encodage des caractères (UTF-8) pour assurer que les caractères spéciaux sont bien affichés. -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Permet l'adaptation de la page à différents types d'écrans (principalement les appareils mobiles). -->
        <title>Admin</title> <!-- Titre de la page, affiché dans l'onglet du navigateur. -->
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <br> <!-- Un saut de ligne pour espacer les éléments HTML. -->
    
        <!-- Lien pour ajouter un nouvel élément -->
        <a href="./ajouter.php">Ajouter</a> <!-- Lien vers la page où l'utilisateur peut ajouter de nouveaux éléments. -->
    
        <!-- Lien pour modifier un élément -->
        <a href="./lire.php">Modifier</a> <!-- Lien vers la page où l'utilisateur peut modifier des éléments existants. -->
    
        <br> <!-- Un autre saut de ligne pour espacer les éléments ci-dessous. -->
    
        <!-- Lien vers la page d'accueil -->
        <a href="../index.php">Index</a> <!-- Lien qui renvoie à la page d'accueil, située à un niveau supérieur dans l'arborescence des répertoires. -->
        <a href="../includes/deconnexion.php">Deconnexion</a>
    </body>
</html>
