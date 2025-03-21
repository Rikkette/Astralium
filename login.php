<?php 
include 'header.php';
// Véfifier si l'utilisateur est connecté
if (isset($_SESSION['users_id'])) {
    // exit('Utilisateur déjà connecté, redirection vers index.php'); // Debug: Message avant redirection
    header('Location: index.php'); // Redirection vers la page d'accueil si l'utilisateur est déjà connecté
    exit();
}


// Traitement de la soumission du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Réception des données du formulaire en méthodes POST
    $login = $_POST['users_email'];
    $password = $_POST['users_password'];

    var_dump($login, $password);


    $stmt = $pdo->prepare("SELECT * FROM users WHERE users_email = :login");;
    $stmt->bindValue(':login', $login);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($user);

        // Récupère le type d'utilisateur pour renseigner la variable de session type_ID
        $stmt = $pdo->prepare("SELECT * FROM type_role WHERE type_role_id = :type_role_id");
        $stmt->bindValue(':type_role_id', $user['type_role_id']);
        $stmt->execute();
        $type = $stmt->fetch(PDO::FETCH_ASSOC);

        // Stocker les informations de type dans la session
        $_SESSION['type_libelle'] = $type['type_libelle'];
        echo "<br>Type d'utilisateur : " . $_SESSION['type_libelle'];
        $_SESSION['logged_in'] = true;
        echo '<meta http-equiv="refresh" content="0;url=index.php">';
        exit();
    } else {
        //Identifiants incorrects, affichage d'un message d'erreur
        $error_message = "Email ou mot de passe incorrect";
    }
?>

<div class="container-connexion">
    <div class="login-box">
        <h2 class="title-connexion">Connexion</h2>
        <?php if (isset($error_message)) : ?>
            <div class="alert alert-danger" role="alert">
                <?= $error_message ?>
            </div>
        <?php endif; ?>
        <form method="POST" class="form-connexion">
            <div class="textbox">
                <input type="text" name="users_email" placeholder="Email" class="input-connexion" autocomplete="on" required>
            </div>
            <br>
            <div class="textbox">
                <input type="password" name="users_password" placeholder="Mot de passe" class="input-connexion" required>
            </div>

            <br>
            <input type="submit" class="btn-connexion" value="Se connecter">
        </form>

    </div>

</div>
</div>


<?php

include 'footer.php';
?>

