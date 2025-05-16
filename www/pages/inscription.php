<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8"> <!-- Définit l'encodage des caractères de la page en UTF-8 pour supporter les caractères spéciaux français. -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure un bon affichage sur les appareils mobiles (adaptation responsive). -->
        <title>Inscription</title> <!-- Le titre de la page qui apparaîtra dans l'onglet du navigateur. -->
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body id=form_b>
        <div id=form_d>
            <h1>Inscription</h1>

            <!-- Formulaire d'inscription -->
            <form method="POST" action="traitement.php"> <!-- Le formulaire envoie les données via la méthode POST au script 'traitement.php'. -->
        
                <!-- Champ pour le nom d'utilisateur -->
                <label for="username">Votre nom</label> <!-- L'étiquette pour le champ du nom d'utilisateur. -->
                <input type="text" id="username" name="username" placeholder="Entrer votre nom" required> <!-- Le champ pour entrer le nom, le champ est requis. -->
                <br> <!-- Saut de ligne pour espacer les éléments du formulaire. -->

            
                <label for="email">Votre Mail</label>
                <input type="email" id="email" name="email" placeholder="Entrer votre adresse mail" required>
                <br>

            
                <label for="password">Votre Mot de Passe</label>
                <input type="password" id="password" name="password" placeholder="Entrer votre mot de passe" required> <!-- Le champ pour entrer le mot de passe, masqué pour la sécurité. -->
                <br>

                <!-- Bouton de soumission -->
                <button type="submit" name="ok">M'inscrire</button> <!-- Le bouton pour soumettre le formulaire. Le nom du bouton est 'ok'. -->
        
                <!-- Bouton d'annulation -->
                <button type="button" onclick="window.location.href='../index.php'">Annuler</button> <!-- Le bouton pour annuler et rediriger vers la page d'accueil (index.php). -->
    
            </form>
        <div>

    </body>
</html>
