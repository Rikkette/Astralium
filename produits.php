<?php
include 'header.php';
?>
<?php

// Initialisation des variables
// $category = isset($_GET['category']) ? $_GET['category'] : '';

// $search = isset($_GET['searchCat']) ? $_GET['searchCat'] : '';
// Requête SQL pour récupérer les produits
$sql = "SELECT * FROM produits p 
join categories c ON p.categorie_id = c.categorie_id";

// Ajout du filtre de recherche si applicable
if (!empty($search)) {
    $sql .= " WHERE produits_nom LIKE '%$search%'";
}

// // Selectionne des produits par catégorie si spécifiée
// if ($category) {
//     $sql .= " WHERE c.categorie_nom = '$category'";
// }

// Exécution de la requête
$produits = $pdo->prepare($sql)->fetchAll(PDO::FETCH_ASSOC);
// Suppression d'un produit
if (isset($_GET['delete'])) {
    $deleteID = $_GET['delete'];
    $stmt = $pdo->prepare("SELECT produits_id FROM produits WHERE produits_id = :id");
    $stmt->execute([':id' => $deleteID]);
    $produits = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produits) {
        $deleteSql = "DELETE FROM produits WHERE produit_ID = :id";
        $stmt = $pdo->prepare($deleteSql);
        $stmt->execute([':id' => $deleteID]);
    }
    header('Location: produits.php');
    exit;
}

// Gestion de l'upload de fichier
// if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
//     $uploads_dir = 'assets/img/';
//     $tmp_name = $_FILES['photo']['tmp_name'];
//     $filename = uniqid() . '_' . basename($_FILES['photo']['name']);
//     $photo_path = $uploads_dir . $filename;
// }
?>
<div class="container my-5">
    <h1 class="mb-4">Nos produits</h1>
    <!--Bouton Ajouter un produit si l'utilisateur est un commercial ou admin -->
    <?php if ($Admin): ?>
        <a href="produit-select.php" class="btn btn-dark">Ajouter un produit</a>
    <?php endif; ?>

    <a href="#" class="btn btn-info">Filtrer par catégorie</a>

    <!-- Liste des produits -->
    <div class="row">
        <?php if (count($produits) > 0): ?>
            <?php foreach ($produits as $produits): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">

                            <!-- <img src="./assets/img/<?= htmlentities($produits['produit_image']) ?>" class="card-img" alt=""> -->

                            <h3 class="card-title"><?= htmlentities($produits['produits_nom']) ?></h3>

                            <p class="card-text"><strong>Catégorie :</strong>
                                <?= htmlentities($produits['categorie_nom']) ?></p>

                            <p class="card-text"><strong>Prix:</strong>
                                        <?= number_format($produits['produits_prix'], 2) ?> € </p>

                                    <p class="card-text"><strong>Description:</strong>
                                        <?= htmlentities($produits['produits_description']) ?></p>

                                    <p class="card-text"><strong>Promotions</strong>
                                        <?= htmlentities($produits['produits_promotions']) ?></p>
                                        
                                    <p class="card-text"><strong>Description:</strong>
                                        <?= htmlentities($produits['produits_quantitees']) ?></p>




                                    <!-- Bouton Ajouter au panier
                            <form action="ajoutpanier.php" method="POST" data-add-to-cart>
                                <input type="hidden" name="action" value="ajouter">
                                <input type="hidden" name="produit_id" value="<?= htmlspecialchars($product['produit_ID']) ?>">
                                <button type="submit" class="btn btn-primary">Ajouter au panier</button>
                            </form> -->

                                    <!-- Boutons Modifier et Supprimer si l'utilisateur est un admin ou commercial -->
                                    <?php if ($Admin): ?>
                                        <a class="btn btn-success" href="produit-select.php?modify=<?= htmlentities($produits['produits_id']) ?>">Modifier</a>
                                        <a class="btn btn-danger" href="produits.php?delete=<?= htmlentities($produits['produits_id']) ?>"
                                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">Supprimer</a>
                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="alert alert-warning" role="alert">
                Aucun produit trouvé.
            </div>
        <?php endif; ?>
    </div>
</div>
<?php
include 'footer.php';
?>