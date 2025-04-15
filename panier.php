<!---ici le panier pour y mettre totu les élèment lors de l'achat --->

<?php

//je lance la session 
session_start();

// Je verifie que le panier existe deja dans la session.
// Si non sa créé un nouveau panier.
if (!isset($_SESSION['Panier'])) {
    $_SESSION['Panier'] = [];
}




























?>