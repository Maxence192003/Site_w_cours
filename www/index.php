<?php
session_start();

// Vérification si l'utilisateur est connecté
$isConnected = false;
if (isset($_SESSION['username'])) {
    $username = htmlspecialchars($_SESSION['username']);
    $isConnected = true;
}

// Connexion à la base de données
$servername = "mysql";
$dbUsername = "root";
$dbPassword = "root";
$dbname = "test_db";

try {
    $bdd = new PDO("mysql:host=$servername;dbname=$dbname", $dbUsername, $dbPassword);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Gestion de la pagination
if (isset($_GET['page']) && !empty($_GET['page'])) {
    $currentPage = (int) strip_tags($_GET['page']);
} else {
    $currentPage = 1;
}

// Nombre total de livres
$sql = 'SELECT COUNT(*) AS nb_livres FROM `biblio`;';
$query = $bdd->prepare($sql);
$query->execute();
$result = $query->fetch();
$nbLivres = (int) $result['nb_livres'];

// Paramètres de pagination
$parPage = 3;
$pages = ceil($nbLivres / $parPage);
$premier = ($currentPage * $parPage) - $parPage;

// Récupération des livres paginés
$sql = 'SELECT * FROM `biblio` ORDER BY `Titre` ASC LIMIT :premier, :parpage;';
$query = $bdd->prepare($sql);
$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);
$query->execute();
$livres = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>
<body>
    <p>Vous êtes sur la page d'accueil</p>
    <a href="./pages/connexion.php">Connexion</a>
    <a href="./pages/inscription.php">Inscription</a>
    <br>

    <?php if ($isConnected): ?>
        <p>Bonjour, <?= $username ?> ! Bienvenue sur la page Index.</p>
    <?php endif; ?>

    <h1>Liste des Livres</h1>
    <div class="contenu">
        <?php foreach ($livres as $livre): ?>
            <div class="contenu2">
                <?php 
                    $imageFromDb = $livre['image'];
                    $defaultImage = 'assets/img/livre/inconnue.jpg';
                    $imagePath = (!empty($imageFromDb) && file_exists($imageFromDb)) 
                        ? $imageFromDb 
                        : $defaultImage;
                ?>
                <img class="image_index" src="<?= $imagePath ?>" alt="Couverture livre">
                <br>
                <a class="contenu3" href="./pages/details.php?titre=<?= urlencode($livre['Titre']) ?>">
                    <?= htmlspecialchars($livre['Titre']) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination améliorée avec 1 page avant et après -->
    <div class="centre">
        <nav>
            <a href="?page=1" class="page-link">&lt;&lt;</a>
            <a href="?page=<?= max($currentPage - 1, 1) ?>" class="page-link">&lt;</a>

            <?php
            $range = 1;
            $ellipsisShown = false;

            for ($page = 1; $page <= $pages; $page++):
                if (
                    $page == 1 || 
                    $page == $pages || 
                    ($page >= $currentPage - $range && $page <= $currentPage + $range)
                ):
            ?>
                <a href="?page=<?= $page ?>" class="page-link <?= ($page == $currentPage) ? 'active' : '' ?>">
                    <?= $page ?>
                </a>
            <?php 
                $ellipsisShown = false;
                elseif (!$ellipsisShown):
                    echo '<span class="page-link">...</span>';
                    $ellipsisShown = true;
                endif;
            endfor;
            ?>

            <a href="?page=<?= min($currentPage + 1, $pages) ?>" class="page-link">&gt;</a>
            <a href="?page=<?= $pages ?>" class="page-link">&gt;&gt;</a>
        </nav>
    </div>
</body>
</html>
