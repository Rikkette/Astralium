<?php
include("header.php");

if (!$Admin) {
    header("Location: index.php");
    exit;
}

// Vérifie si l'id existe dans l'URL, modify si c'est le cas
$id = isset($_GET['modify']) ? $_GET['modify'] : '';
$libelle = $idValue = '';
$idProduit = null;

// Création d'un tableau categories avec une requête SQL recherchant les ids et libelles de la table categorie 
$categories = [];
$categories = $pdo->prepare("SELECT * FROM categories")->fetchAll();

// Si l'ID existe, une requête SQL récupérant la table produit et categorie où l'ID correspond à l'ID sélectionné 
if ($id !== '') {
    $sql = "SELECT * FROM produits p JOIN categories c ON p.categorie_id = c.categorie_id WHERE p.produits_id = '$id'";
    $result = $pdo->prepare($sql);
    $product = $result->fetch(PDO::FETCH_ASSOC);

    
    // Si la requête SQL trouve des éléments, on définit les différents variables pour les relier aux colonnes SQL. Sinon on indique que le produit est introuvable
    if ($produits) {
        $libelle = $produits['produit_produits_nom'];
        $description = $produits['produits_description'];
        $prix = $produits['produits_prix'];
        $promotions = $produits['produits_promotions'];
        $quantites = $produits['produits_quantitees'];
        
        $categorie = $produits['categorie_id'];

        $idValue = $produits['produits_id'];
        $idProduit = $produits['produits_id'];
    } else {
        echo "Produit introuvable.";
        exit;
    }
}

// Si la méthode POST s'active, on définit les différent variables pour les relier aux valeur de name dans le formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $libelle = $_POST['produits_nom'];
    $prix = $_POST['produits_prix'];
    $description = $_POST['produits_description'];
    $categorie = $_POST['categories'];
    $promotions = $_POST['produits_promotions'];
    $quantitees = $_POST['produits_quantitees'];
    
// Si l'id du produit existe, on le met à jour. Sinon on le créer.
    if ($idProduit !== null) {
        $stmt = $pdo->prepare ("UPDATE produits SET 
        produits_nom = ?,
        produits_description = ?,
        produits_prix = ?,
        produits_promotions = ?,
        produits_quantitees = ? ,
        categorie_id = ? ,
        WHERE produits_id = ?");
        $stmt->execute([$libelle, $prix, $description, $categorie, $promotions, $quantitees, $idProduit]);
    } else {
        $stmt = $pdo->prepare("INSERT INTO produits (produits_nom, produits_description ,produits_prix, produits_promotions, produits_quantitees, categorie_id) 
        VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([ $libelle, $prix, $description, $categorie, $promotions, $quantitees]);
    }

    // Redirection vers la page produit.php après modification ou création
    header('Location: boutique.php');
    exit;
}

// // Gestion de l'upload de fichier
// if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
//     $uploads_dir = 'assets/img/';
//     $tmp_name = $_FILES['photo']['tmp_name'];
//     $filename = uniqid() . '_' . basename($_FILES['photo']['name']);
//     $photo_path = $uploads_dir . $filename;

//     if (move_uploaded_file($tmp_name, $photo_path)) {
//         $photo = $filename;
//     } else w{
//         $message = "Erreur lors de l'upload de la photo.";
//     }
// }

?>

<!-- Formulaire qui indique si on modifie ou créer un produit selon si l'id récupéré existe-->
<div class="container my-5">
    <h1 class="mb-4"><?= $id ? "Modification" : "Création" ?> d'un produit</h1>

    <form method="post">
        <div class="mb-3">
            <!-- <label for="image" class="form-label">Image du produit: </label>
            <input type="file" class="form-control" id="image" name="produit_image" value="<?= $id ? htmlentities($photo) : "" ?>"> -->

            <label for="libelle" class="form-label">Nom du produit: </label>
            <input type="text" class="form-control" id="libelle" name="produits_nom" value="<?= $id ? htmlentities($libelle) : "" ?>" required>

            <label for="categorie" class="form-label">Catégorie du produit: </label>
            <select name="categorie" class="form-control" id="categorie">
                <?php foreach($categories as $categorieValue):?>
                    <option value="<?= $categorieValue['categorie_ID'] ?>" <?= (isset($produits['categorie_id']) && $product['categorie_id'] == $categorieValue['categorie_id']) ? 'selected' : '' ?>>
                    <?= htmlentities($categorieValue['categorie_nom']) ?>
                </option>
                <?php endforeach ?>
            </select>
            

            <label for="prix" class="form-label">Prix du produit: </label>
            <input type="text" class="form-control" id="prix" name="produits_prix" value="<?= $id ? htmlentities($prix) : "" ?>" required>

            <label for="description" class="form-label">Description du produit: </label>
            <input type="text" class="form-control" id="description" name="produits_description" value="<?= $id ? htmlentities($description) : "" ?>" required>

            <label for="description" class="form-label">promotions: </label>
            <input type="text" class="form-control" id="promotions" name="produits_promotions" value="<?= $id ? htmlentities($promotions) : "" ?>" required>

            <label for="description" class="form-label">Quantitées </label>
            <input type="text" class="form-control" id="description" name="produits_quantitees" value="<?= $id ? htmlentities($quantitees) : "" ?>" required>

        </div>
        <!-- Si l'id du produit existe, on met une valeur cachée pour l'id dans le formulaire pour que le formulaire ne se recharge pas lors du retour à la page produits.php-->
        <input type="hidden" name="id" value="<?= $idValue ?>">
    
                
                 
               <button type="submit" class="btn btn-warning"><?= $id ? "Mettre à jour" : "Créer" ?></button>
        <a href="produits.php" class="btn btn-dark">Retour</a>
    </form>
</div>

<?PHP
include("footer.php");
?>