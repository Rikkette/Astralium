
<?php



// Je définis la langue par défaut (FR)
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'fr';
}

// Si on change de langue via un paramètre GET
if (isset($_GET['lang'])) {
    $language = $_GET['lang'];
    
    // Je vérifie que la langue demandée est disponible
    if ($language == 'fr' || $language == 'en') {
        $_SESSION['lang'] = $language;
    }
}

// Ici j'inclus le fichier de traduction correspondant à la langue actuelle
include_once 'Trad_FR-EN/' . $_SESSION['lang'] . '_langue.php';
?>