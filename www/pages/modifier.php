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

    // Inclusion de la connexion à la base de données
    include '../includes/connexion.php';

    // Vérifier si un titre ou un ID est passé en paramètre dans l'URL
    if (!isset($_GET['titre']) && !isset($_GET['id'])) {
        die("Aucun livre sélectionné.");  // Si aucun paramètre n'est passé, afficher un message d'erreur et arrêter l'exécution
    }

    // Si un titre est passé en paramètre
    if (isset($_GET['titre'])) {
        $titre = urldecode($_GET['titre']); // Décoder le titre URL-encodé
        // Préparer la requête pour récupérer les informations du livre basé sur le titre
        $requete = $bdd->prepare("SELECT * FROM biblio WHERE Titre = ?");
        $requete->execute([$titre]);  // Exécuter la requête avec le titre passé en paramètre
        $livre = $requete->fetch(PDO::FETCH_ASSOC); // Récupérer les données du livre sous forme de tableau associatif
    } 
    elseif (isset($_GET['id'])) {
        $id = $_GET['id'];  // Récupérer l'ID du livre passé en paramètre
        // Préparer la requête pour récupérer les informations du livre basé sur l'ID
        $sql = "SELECT * FROM biblio WHERE id_titre = :id";
        $stmt = $bdd->prepare($sql);
        $stmt->execute(['id' => $id]);  // Exécuter la requête avec l'ID
        $livre = $stmt->fetch(PDO::FETCH_ASSOC);  // Récupérer les données du livre
    }

    // Si aucun livre n'est trouvé avec l'ID ou le titre donné
    if (!$livre) {
        die("Livre introuvable.");  // Afficher un message d'erreur si le livre n'existe pas
    }

    // Traitement du formulaire de mise à jour
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupérer les nouvelles valeurs soumises par l'utilisateur
        $titre = trim($_POST['titre']);
        $auteur = trim($_POST['auteur']);
        $bio = trim($_POST['bio']);
        $desc = trim($_POST['desc']);
        $imagePath = $livre['image'];  // Garder l'image actuelle si aucune nouvelle image n'est téléchargée

        // Vérifier si une nouvelle image a été téléchargée
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Vérifier le type et la taille de l'image téléchargée
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $maxSize = 5 * 1024 * 1024; // 5MB max

            // Vérifier si le type de l'image est autorisé et si sa taille est acceptable
            if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
                $uploadDir = '../assets/img/livre/';  // Dossier de destination pour l'image
                // Si le dossier n'existe pas, le créer
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);  // Créer le dossier avec les bonnes permissions
                }

                // Générer un nom unique pour l'image afin d'éviter les conflits de noms
                $imageName = uniqid() . '-' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $imageName;  // Chemin complet du fichier téléchargé

                // Supprimer l'ancienne image si elle existe
                if ($livre['image'] && file_exists($uploadDir . $livre['image'])) {
                    unlink($uploadDir . $livre['image']);  // Supprimer l'ancienne image
                }

                // Déplacer le fichier téléchargé dans le dossier de destination
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $imagePath = 'assets/img/livre/' . $imageName;  // Mettre à jour le chemin de l'image dans la base de données
                } 
                else {
                    echo "<p style='color:red;'>Erreur lors du téléchargement de l'image.</p>";
                }
            } 
            else {
                echo "<p style='color:red;'>L'image doit être de type JPEG, PNG ou GIF et ne pas dépasser 5MB.</p>";
            }
        }

        // Vérifier si un autre livre avec le même titre et auteur existe déjà
        $sqlCheck = "SELECT COUNT(*) FROM biblio WHERE Titre = :titre AND Auteur = :auteur AND id_titre != :id";
        $stmtCheck = $bdd->prepare($sqlCheck);
        $stmtCheck->execute(['titre' => $titre, 'auteur' => $auteur, 'id' => $id]);  // Exécuter la vérification
        $count = $stmtCheck->fetchColumn();  // Récupérer le nombre de livres trouvés

        // Si un autre livre avec le même titre et auteur existe, afficher un message d'erreur
        if ($count > 0) {
            echo "<p style='color:red;'>Erreur : Un livre avec ce titre et cet auteur existe déjà.</p>";
        } 
        else {
            // Si aucune erreur, mettre à jour les informations du livre
            $sql = "UPDATE biblio SET Titre = :titre, Auteur = :auteur, Bio = :bio, `Desc` = :desc, image = :image WHERE id_titre = :id";
            $stmt = $bdd->prepare($sql);

            // Exécuter la requête de mise à jour
            if ($stmt->execute([
                'titre' => $titre,
                'auteur' => $auteur,
                'bio' => $bio,
                'desc' => $desc,
                'image' => $imagePath,  // Mettre à jour l'image du livre
                'id' => $id
            ])) 
            {
                echo "<p style='color:green;'>Livre mis à jour avec succès.</p>";
                echo "<br><a href='lire.php'>Retour à la liste</a>";
                exit;  // Terminer le script après la mise à jour
            } 
            else {
                echo "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
            }
        }
    }
?>

<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Modifier un Livre</title>
        <link rel="stylesheet" href="../assets/css/style.css">
    </head>
    <body>
        <h2>Modifier le Livre</h2>
        <form method="post" enctype="multipart/form-data">
            <label>Titre :</label>
            <input type="text" name="titre" value="<?= htmlspecialchars($livre['Titre']) ?>" required><br>

            <label>Auteur :</label>
            <input type="text" name="auteur" value="<?= htmlspecialchars($livre['Auteur']) ?>" required><br>

            <label>Biographie :</label>
            <textarea name="bio" required><?= htmlspecialchars($livre['Bio']) ?></textarea><br>

            <label>Description :</label>
            <textarea name="desc" required><?= htmlspecialchars($livre['Desc']) ?></textarea><br>

            <label>Image (optionnelle) :</label>
            <input type="file" name="image"><br>
        
            <?php if (!empty($livre['image'])): ?>
                <p>Image actuelle :</p>
                <img src="../<?= htmlspecialchars($livre['image']) ?>" alt="Image du livre" width="150"><br>
            <?php endif; ?>

            <input type="submit" value="Mettre à jour">
        </form>
        <br>
        <a href="lire.php">Annuler</a>
    </body>
</html>

