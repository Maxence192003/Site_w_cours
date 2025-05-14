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

    // Inclusion du fichier de connexion à la base de données
    include '../includes/connexion.php';

    // Récupérer tous les livres existants depuis la base de données
    $sql = "SELECT id_titre, Titre FROM biblio";  // Requête SQL pour récupérer l'ID et le Titre des livres
    $stmt = $bdd->query($sql);  // Exécution de la requête
    $livres = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Récupération des résultats sous forme de tableau associatif
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Supprimer un Livre</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <h2>Supprimer un Livre</h2>

        <!-- Formulaire de suppression -->
        <form method="POST" action="traitement_biblio.php">
            <!-- Label et champ de sélection pour choisir un livre -->
            <label for="livre">Sélectionnez un livre à supprimer :</label>
            <select name="id_titre" required>
                <option value="">Choisir un livre...</option>
                <!-- Boucle pour afficher tous les livres disponibles dans un menu déroulant -->
                <?php foreach ($livres as $livre): ?>
                    <option value="<?= htmlspecialchars($livre['id_titre']) ?>"><?= htmlspecialchars($livre['Titre']) ?></option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <!-- Bouton pour soumettre le formulaire et supprimer le livre -->
            <button type="submit" name="note_ok">Supprimer</button>
        
            <!-- Bouton pour annuler l'opération et revenir à la page Admin -->
            <button type="button" onclick="window.location.href='lire.php'">Annuler</button>
        </form>
    </body>
</html>

