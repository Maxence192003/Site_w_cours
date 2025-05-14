<?php
// Inclure le fichier de connexion à la base de données
include '../includes/connexion.php';

// Vérifier si un titre est passé en paramètre dans l'URL
if (!isset($_GET['titre'])) {
    die("Aucun livre sélectionné."); // Si aucun titre n'est fourni, arrêter l'exécution et afficher un message d'erreur.
}

$titre = urldecode($_GET['titre']); // Décoder le titre reçu dans l'URL pour le rendre lisible.

// Récupérer les détails du livre depuis la base de données
$requete = $bdd->prepare("SELECT * FROM biblio WHERE Titre = ?"); // Préparation de la requête SQL avec un paramètre sécurisé
$requete->execute([$titre]); // Exécution de la requête en remplaçant le "?" par le titre du livre
$livre = $requete->fetch(PDO::FETCH_ASSOC); // Récupération du livre sous forme de tableau associatif

// Vérifier si le livre existe
if (!$livre) {
    die("Livre introuvable."); // Si aucun livre ne correspond, afficher un message d'erreur et arrêter l'exécution
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8"> <!-- Définition de l'encodage pour éviter les problèmes d'affichage des accents -->
    <title><?= htmlspecialchars($livre['Titre']) ?></title> <!-- Affichage sécurisé du titre du livre dans l'onglet du navigateur -->
    <link rel="stylesheet" href="../assets/css/style.css"> <!-- Inclusion du fichier CSS pour le style -->
</head>
<body>

    <!-- Conteneur principal -->
    <div class="livre-container">
        <!-- Tableau structurant l'affichage du livre -->
        <table class="livre-table">
            <!-- Ligne contenant le titre du livre -->
            <tr>
                <th class="livre-titre" colspan="2"><?= htmlspecialchars($livre['Titre']) ?></th> 
                <!-- colspan="2" permet d'étendre la cellule sur deux colonnes -->
            </tr>

            <!-- Ligne contenant l'image et les informations -->
            <tr>
                <!-- Colonne de l'image -->
                <td class="livre-image-cell">
                    <?php 
                    // Vérification de l'existence de l'image
                    $imagePath = !empty($livre['image']) && file_exists('../' . $livre['image']) 
                        ? '../' . $livre['image']  // Si l'image existe, on utilise son chemin
                        : '../assets/img/livre/inconnue.jpg'; // Sinon, on affiche une image par défaut
                    ?>
                    <img class="livre-image" src="<?= $imagePath ?>" alt="Image du livre"> <!-- Affichage de l'image -->
                </td>

                <!-- Colonne contenant les informations du livre -->
                <td class="livre-info-cell">
                    <div class="livre-info">
                        <span class="livre-label">Auteur :</span> <?= htmlspecialchars($livre['Auteur']) ?> 
                        <!-- Affichage sécurisé de l'auteur -->
                    </div>
                    <div class="livre-info">
                        <span class="livre-label">Biographie :</span> <?= nl2br(htmlspecialchars($livre['Bio'])) ?> 
                        <!-- Affichage sécurisé de la biographie avec conservation des retours à la ligne -->
                    </div>
                    <div class="livre-info">
                        <span class="livre-label">Description :</span> <?= nl2br(htmlspecialchars($livre['Desc'])) ?> 
                        <!-- Affichage sécurisé de la description avec conservation des retours à la ligne -->
                    </div>
                </td>
            </tr>
        </table>

        <!-- Lien de retour à la liste des livres -->
        <p class="livre-retour">
            <a href="../index.php">Retour à la liste</a>
        </p>
    </div>

</body>
</html>




