<?php

    // Inclusion du fichier de connexion à la base de données
    include '../includes/connexion.php';

    // Vérifier si le formulaire d'ajout de livre a été soumis
    if (isset($_POST['okay'])) {
        // Récupérer les données du formulaire et les nettoyer
        $Titre = trim($_POST['Titre']);  // Retirer les espaces inutiles avant et après le titre
        $Auteur = trim($_POST['Auteur']);  // Retirer les espaces inutiles avant et après l'auteur
        $Bio = trim($_POST['Bio']);  // Retirer les espaces inutiles avant et après la biographie
        $Desc = trim($_POST['Desc']);  // Retirer les espaces inutiles avant et après la description
        $imagePath = null;  // Par défaut, aucune image

        // Vérifier si un livre avec le même titre et auteur existe déjà dans la base de données
        $requeteCheck = $bdd->prepare("SELECT COUNT(*) FROM biblio WHERE Titre = ? AND Auteur = ?");
        $requeteCheck->execute([$Titre, $Auteur]);
        $count = $requeteCheck->fetchColumn();

        // Si un livre existe déjà avec le même titre et auteur, afficher une erreur et arrêter le processus
        if ($count > 0) {
            echo "Erreur : Un livre avec ce titre et cet auteur existe déjà.";
            exit;  // Arrêter l'exécution du script
        }

        // Vérifier si une image a été téléchargée
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            // Types de fichiers autorisés
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            // Taille maximale de l'image (5MB)
            $maxSize = 5 * 1024 * 1024;

            // Vérifier si le type et la taille du fichier sont valides
            if (in_array($_FILES['image']['type'], $allowedTypes) && $_FILES['image']['size'] <= $maxSize) {
                // Définir le répertoire de destination pour l'image
                $uploadDir = '../assets/img/livre/';
            
                // Si le répertoire n'existe pas, le créer
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);  // Crée le répertoire avec les permissions nécessaires
                }

                // Créer un nom unique pour l'image
                $imageName = uniqid() . '-' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $imageName;

                // Déplacer l'image téléchargée dans le répertoire de destination
                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                    $imagePath = 'assets/img/livre/' . $imageName;  // Enregistrer le chemin relatif de l'image
                } 
                else {
                    echo "<p style='color:red;'>Erreur lors du téléchargement de l'image.</p>";
                    exit;  // Arrêter le processus si l'image ne peut pas être téléchargée
                }
            } 
            else {
                // Si l'image n'est pas valide (type ou taille incorrects)
                echo "<p style='color:red;'>L'image doit être de type JPEG, PNG ou GIF et ne pas dépasser 5MB.</p>";
                exit;  // Arrêter l'exécution du script
            }
        }

        // Insérer les informations du livre dans la base de données
        $requete = $bdd->prepare("INSERT INTO biblio (Titre, Auteur, Bio, `Desc`, image) VALUES (?, ?, ?, ?, ?)");
    
        // Exécuter la requête d'insertion
        if ($requete->execute([$Titre, $Auteur, $Bio, $Desc, $imagePath])) {
            // Si l'insertion réussit, afficher un message de succès
            echo "<p style='color:green;'>Livre ajouté avec succès.</p>";
            echo "<br><a href='../index.php'>Voir la liste</a>";
            exit;  // Arrêter l'exécution du script
        } 
        else {
            // Si l'insertion échoue, afficher un message d'erreur
            echo "<p style='color:red;'>Erreur lors de l'ajout du livre.</p>";
        }
    }

    // Vérifier si le formulaire de suppression a été soumis
    if (isset($_POST['note_ok']) && isset($_POST['id_titre'])) {
        // Récupérer l'ID du livre à supprimer
        $id_titre = $_POST['id_titre'];

        // Récupérer le chemin de l'image associée au livre à supprimer
        $requeteImage = $bdd->prepare("SELECT image FROM biblio WHERE id_titre = ?");
        $requeteImage->execute([$id_titre]);
        $image = $requeteImage->fetchColumn();

        // Si une image existe et qu'elle est présente sur le serveur, la supprimer
        if ($image && file_exists('../' . $image)) {
            unlink('../' . $image);  // Supprimer l'image du serveur
        }

        // Supprimer le livre de la base de données
        $requete = $bdd->prepare("DELETE FROM biblio WHERE id_titre = ?");
        $requete->execute([$id_titre]);

        // Vérifier si la suppression a réussi
        if ($requete->rowCount() > 0) {
            // Si le livre a été supprimé, afficher un message de succès
            echo "Le livre a été supprimé avec succès.";
        } 
        else {
            // Si aucune ligne n'a été supprimée (livre non trouvé), afficher une erreur
            echo "Aucun livre trouvé avec cet ID. La suppression a échoué.";
        }
    }
?>
