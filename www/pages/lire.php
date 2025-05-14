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


    // Inclure le fichier de connexion à la base de données
    include '../includes/connexion.php';

    // Récupérer les données de la table `biblio`
    try {
        // Requête SQL pour récupérer tous les livres de la table biblio
        $sql = "SELECT * FROM biblio";
        $stmt = $bdd->query($sql); // Exécution de la requête
        $livres = $stmt->fetchAll(PDO::FETCH_ASSOC); // Récupération des résultats sous forme de tableau associatif
    } 
    catch (PDOException $e) {
        // Si une erreur SQL se produit, afficher un message d'erreur
        die("Erreur SQL : " . $e->getMessage());
    }
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8"> <!-- Définit l'encodage des caractères en UTF-8 pour supporter les caractères spéciaux français -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Assure une présentation responsive sur les appareils mobiles -->
        <title>Liste des Livres</title> <!-- Titre de la page dans l'onglet du navigateur -->
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>

        <h2>Liste des Livres</h2> <!-- Titre principal de la page -->

        <table> <!-- Table pour afficher la liste des livres -->
            <tr>
                <!-- En-têtes des colonnes -->
                <th>ID</th>
                <th>Titre</th>
                <th>Auteur</th>
                <th>Bio</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>

            <!-- Afficher les livres si la table n'est pas vide -->
            <?php if (count($livres) > 0): ?>
                <!-- Boucle pour afficher chaque livre dans un tableau -->
                <?php foreach ($livres as $livre): ?>
                    <tr>
                        <!-- Affichage des informations de chaque livre -->
                        <td><?= htmlspecialchars($livre['id_titre']) ?></td> <!-- ID du livre -->
                        <td><?= htmlspecialchars($livre['Titre']) ?></td> <!-- Titre du livre -->
                        <td><?= htmlspecialchars($livre['Auteur']) ?></td> <!-- Auteur du livre -->
                        <td><?= htmlspecialchars($livre['Bio']) ?></td> <!-- Biographie de l'auteur -->
                        <td><?= htmlspecialchars($livre['Desc']) ?></td> <!-- Description du livre -->
                        <td>
                            <!-- Liens pour modifier ou supprimer un livre -->
                            <a class="lien_noir" href="modifier.php?id=<?= $livre['id_titre'] ?>">Modifier</a> | 
                            <a class="lien_noir" href="suprime.php?id=<?= $livre['id_titre'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer ce livre ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Message si aucun livre n'est trouvé -->
                <tr><td colspan='6'>Aucun livre trouvé.</td></tr>
            <?php endif; ?>
        </table>

        <br> <!-- Saut de ligne -->
    
        <!-- Lien pour ajouter un nouveau livre -->
        <a href="ajouter.php">Ajouter un Livre</a>
        <br>
        <a href="Admin.php">Retour</a> 

    </body>
</html>

