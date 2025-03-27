<?php
include("header.php");

if (!$Admin) {
    header("Location: index.php");
    exit;
}


// Création d'un tableau categories avec une requête SQL recherchant les ids et libelles de la table categorie 
$categories = [];
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Si la méthode POST s'active, on définit les différent variables pour les relier aux valeur de name dans le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libelle = $_POST['produit_nom'];
    $prix = $_POST['produits_prix'];
    $description = $_POST['produits_description'];
    $categorie = $_POST['categorie_nom'];
    $promotions = $_POST['produits_promotions'];
    $quantitees = $_POST['produits_quantitees'];

        $stmt = $pdo->prepare("INSERT INTO produits (produits_nom, produits_description ,produits_prix, produits_promotions, produits_quantitees, categorie_id) 
        VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$libelle, $prix, $description, $categorie, $promotions, $quantitees]);

    // Redirection vers la page produit.php après modification ou création
    header('Location: boutique.php');
    exit;
}
?>

<!-- Formulaire qui indique si on modifie ou créer un produit selon si l'id récupéré existe-->
<div class="container my-5">
    <h1 class="mb-4">Création d'un produit</h1>

    <form method="post">
        <div class="mb-3">
            <!-- <label for="image" class="form-label">Image du produit: </label>
            <input type="file" class="form-control" id="image" name="produit_image" value=""> -->

            <label for="libelle" class="form-label">Nom du produit: </label>
            <input type="text" class="form-control" id="libelle" name="produit_nom" required>

            <label for="categorie" class="form-label">Catégorie du produit: </label>
            <select name="categorie" class="form-select" id="categorie">
                <?php foreach ($categories as $categorieValue): ?>
                    <option value="<?= $categorieValue['categorie_id']?>">
                        <?= htmlentities($categorieValue['categorie_nom']) ?>
                    </option>
                <?php endforeach ?>
            </select>


            <label for="prix" class="form-label">Prix du produit: </label>
            <input type="text" class="form-control" id="prix" name="produits_prix" required>

            <label for="description" class="form-label">Description du produit: </label>
            <input type="text" class="form-control" id="description" name="produits_description" required>

            <label for="description" class="form-label">promotions: </label>
            <input type="text" class="form-control" id="promotions" name="produits_promotions" required>

            <label for="description" class="form-label">Quantitées </label>
            <input type="text" class="form-control" id="description" name="produits_quantitees" required>

        </div>
        <!-- Si l'id du produit existe, on met une valeur cachée pour l'id dans le formulaire pour que le formulaire ne se recharge pas lors du retour à 
         la page produits.php-->
        <input type="hidden" name="id">

        <button type="submit" class="btn btn-warning">créer</button>
        <a href="produits.php" class="btn btn-dark">Retour</a>
    </form>
</div>

<?PHP
include("footer.php");
?>