<?php
//-----------------------------je lance la session ---------------------------

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

  // Récupération du nom du fichier PHP en cours sans extension
  echo ucfirst(basename($_SERVER['PHP_SELF'], '.php'));

// -----------------------Configuration de la base de données-------------------------

$host = '127.0.0.1';
$dbname = 'bddastralium';
$username = 'root';
$password = '';

try {
  // ----------------------Connexion à la base de données------------------------------
  $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  die("Erreur de connexion : " . $e->getMessage());
}

  // Vérifiez si l'utilisateur est connecté
  $username = null;
  if (isset($_SESSION['users_id'])) {
    $userId = $_SESSION['users_id'];

    // Récupération des informations de l'utilisateur
    $sqlUser = "SELECT * FROM users WHERE users_id=:users_id";
    $stmtUser = $pdo->prepare($sqlUser);
    $stmtUser->execute(['users_id' => $userId]);
    $user = $stmtUser->fetch(PDO::FETCH_ASSOC);

    if ($user) {
      $username = $user['users_id'];
    }
  }
$Admin = isset($_SESSION['type_libelle']) && in_array($_SESSION['type_libelle'], ['admin']);
$isLoggedIn=isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true;

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-------------------------- link bootstrap ---------------------------------------------->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="Style/style.css">
</head>
<!---------------------------- Titre de la page----------------------------------------->


<!-------------------------- Drapeau langue EN & FR ------------------------->
<div class="banniereHeader">
  <div class="drapeau">
    <img src="Style/logo/drap_en.png" width="40" height="30" alt="Anglais" class="drapeau-img" style="cursor: pointer;">
    <img src="Style/logo/drap_fr.png" width="40" height="30" alt="Français" class="drapeau-img" style="cursor: pointer;">
  </div>
 <img src="Style/logo/banniere header.png" class="banniere">
</div>

<!-------------------------- Banniere Astralium ---------------------------->



<!-------------------------- Nav bar bootstrap : barre de recherche ------------------------------>

<nav class="navbar navbar-light bg-light">
  <form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
  </form>
</nav>

<!------------------------------ Nav Bar bootstrap :  ---------------------------->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav">
      <!--------------- Accueil ---------------->
      <li class="nav-item">
        <a class="nav-link" href="index.php">Accueil</a>
      </li>
      <!--------------- Boutique --------------->
      <li class="nav-item active">
        <a class="nav-link" href="produits.php">Boutique</a>
      </li>
      <!--------------- Portfolio -------------->
      <li class="nav-item">
        <a class="nav-link" href="portfolio.php">Portfolio</a>
      </li>
      <!--------------- A propos --------------->
      <li class="nav-item">
        <a class="nav-link" href="apropos.php">À propos</a>
      </li>
      <!----------------- blog ---------------->
      <li class="nav-item">
        <a class="nav-link" href="blog.php">Blog</a>
      </li>
      <!--------------- newsletter -------------->
      <li class="nav-item">
        <a class="nav-link" href="#">NewsLetter</a>
      </li>
      <!--------------- Me contacter -------------->
      <li class="nav-item">
        <a class="nav-link" href="#">Me contacter</a>
      </li>

      <li></li>
       <!-- Bouton Connexion/Déconnexion -->
       <?php if ($isLoggedIn): ?>
          <a href="logout.php" class="position">Déconnexion</a>
        <?php else: ?>
          <a href="login.php" class="position">Connexion</a>
        <?php endif; ?>
        </li>

    </ul>
  </div>
</nav>