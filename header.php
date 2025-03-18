<?php
//-----------------------------je lance la session ---------------------------

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// -----------------------Configuration de la base de données-------------------------

$host = '127.0.0.1';
$dbname = 'bddastralium';
$username = 'root';
$password = '';

try {
    // ----------------------Connexion à la base de données------------------------------
    $pdo = new PDO('mysql:host=localhost;dbname=bddastralium;charset=utf8', $username, $password);
} catch (PDOException $e) {
    print "Erreur :" . $e->getMessage() . "<br/>";
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-------------------------- link bootstrap ---------------------------------------------->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!---------------------------- Titre de la page----------------------------------------->
    <title></title>
    <!-------------------------- Banniere Astralium ---------------------------->
    <center><img src="Style/logo/banniere header.png"></center>
    <!-------------------------- Drapeau langue EN & FR ------------------------->
    <img src="Style/logo/drap_en.png"width="40" height="30">
    <img src="Style/logo/drap_fr.png"width="40" height="30">
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
    <li class="nav-item">
        <a class="nav-link" href="#">Accueil</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Boutique</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Portfolio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">À propos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">NewsLetter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Me contacter</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">FAQ</a>
      </li>
        </div>
      </li>
    </ul>
  </div>
</nav>
<!------------------------------------------------------------------------------------------------------------>
</head>
<body>
</body>
</html>