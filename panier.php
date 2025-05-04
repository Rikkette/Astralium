<!--- Page panier pour y mettre tout les produits lors de l'achat --->
<!--comment gere les numero d'envoie de colies par email automatiquement pour les clients sans le faire manuellement ? -->

<?php

//je lance la session 
session_start();

// Je verifie que le panier existe deja dans la session.
// Si non sa créé un nouveau panier.
if (!isset($_SESSION['Panier'])) {
    $_SESSION['Panier'] = [];
}

?>




























?>