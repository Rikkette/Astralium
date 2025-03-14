<?php

//je lance la session 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configuration de la base de données

$host = '127.0.0.1';
$dbname = 'bddastralium';
$username = 'root';
$password = '';

// Connexion à la base de données

try {
    $db = new PDO('mysql:host=localhost;dbname=bddastralium;charset=utf8', $username, $password);
    foreach ($db->query('SELECT * FROM articles') as $row) {
        print_r($row);
    }
} catch (PDOException $e) {
    print "Erreur :" . $e->getMessage() . "<br/>";
    die;
}
