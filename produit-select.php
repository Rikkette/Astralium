<!---Page pour afficher les produit dans le shop avec les categories mais aussi pour ajouter des produit via formulaire-->

<?php
include("header.php");

// Uniquement si on est grade "admin" si non la personne est renvoyée vers l'index
if (!isset($Admin) || !$Admin) {
    echo '<meta http-equiv="refresh" content="0;url=../index.php">';
    exit;
}

// Récupération des catégories depuis la base de données
$categories = $pdo->query("SELECT * FROM categories")->fetchAll();

// Traitement du formulaire lors de la soumission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et validation des données du formulaire
    $libelle = trim($_POST['produit_nom']);
    $description = trim($_POST['produits_description']);
    $prix = floatval($_POST['produits_prix']);
    $promotions = trim($_POST['produits_promotions']);
    $quantitees = intval($_POST['produits_quantitees']);
    $categorie = isset($_POST['categorie']) ? intval($_POST['categorie']) : null;

    // Vérification de l'existence de la catégorie
    $check = $pdo->prepare("SELECT COUNT(*) FROM categories WHERE categorie_id = ?");
    $check->execute([$categorie]);
    if ($check->fetchColumn() == 0) {
        $message = "Erreur : La catégorie sélectionnée n'existe pas.";
    } else {
        // Insertion du produit dans la base de données
        $stmt = $pdo->prepare("INSERT INTO produits (produits_nom, produits_description, produits_prix, produits_promotions, produits_quantitees, categorie_id) 
            VALUES (:nom, :description, :prix, :promotions, :quantitees, :categorie)");
        $stmt->execute([
            ':nom' => $libelle,
            ':description' => $description,
            ':prix' => $prix,
            ':promotions' => $promotions,
            ':quantitees' => $quantitees,
            ':categorie' => $categorie,
        ]);

        // Récupération de l'ID du produit inséré
        $nouveau_produit_id = $pdo->lastInsertId();

        // Traitement des images
        if (!empty($_FILES['produit_image']) && $_FILES['produit_image']['error'] === UPLOAD_ERR_OK) {
            $uploads_dir = 'uploads/';
            $tmp_name = $_FILES['produit_image']['tmp_name'];
            $filename = uniqid() . '_' . basename($_FILES['produit_image']['name']);
            $file_path = $uploads_dir . $filename;

            if (move_uploaded_file($tmp_name, $file_path)) {
                // Insertion des informations de l'image dans la base de données
                $sql = "INSERT INTO media (produits_id, media_libelle) VALUES (:produits_id, :media_libelle)";
                $request = $pdo->prepare($sql);
                $request->execute([
                    ':media_libelle' => $filename,
                    ':produits_id' => $nouveau_produit_id
                ]);
            }
        }

        // Redirection vers la page des produits après création
        header('Location: produits.php');
        exit;
    }
}
?>

<!-------------------------- Formulaire de création d'un produit ----------------------------->
<div class="container my-5">
    <h1 class="mb-4">Création d'un produit</h1>

    <?php if (isset($message)): ?>
        <div class="alert alert-danger"><?= htmlentities($message) ?></div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        
        <div class="mb-3">
            <!--Ici j'ajoute une image pour illustrer le produit -->
            <label for="produit_image" class="form-label">Image du produit: </label>
            <input type="file" class="form-control" id="produit_image" name="produit_image" multiple required>
        </div>

        <div class="mb-3">
            <!--Nom du produit -->
            <label for="produit_nom" class="form-label">Nom du produit: </label>
            <input type="text" class="form-control" id="produit_nom" name="produit_nom" required>
        </div>

        <div class="mb-3">
            <!--Catégorie du produit -->
            <label for="categorie" class="form-label">Catégorie du produit: </label>
            <select name="categorie" class="form-select" id="categorie" required>
                <option value="">Sélectionner une catégorie</option>
                <?php foreach ($categories as $categorieValue): ?>
                    <option value="<?= htmlentities($categorieValue['categorie_id']) ?>">
                        <?= htmlentities($categorieValue['categorie_nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <!--Prix du produit -->
            <label for="produits_prix" class="form-label">Prix du produit (€): </label>
            <input type="number" step="0.01" class="form-control" id="produits_prix" name="produits_prix" required>
        </div>

        <div class="mb-3">
            <!--Description du produit -->
            <label for="produits_description" class="form-label">Description du produit: </label>
            <textarea class="form-control" id="produits_description" name="produits_description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <!--Promotions -->
            <label for="produits_promotions" class="form-label">Promotions: </label>
            <input type="text" class="form-control" id="produits_promotions" name="produits_promotions">
        </div>

        <div class="mb-3">
            <!--Quantité disponible -->
            <label for="produits_quantitees" class="form-label">Quantité disponible: </label>
            <input type="number" min="0" class="form-control" id="produits_quantitees" name="produits_quantitees" required>
        </div>

        <!--bouton pour soumettre le formulaire d'ajout de produit -->
        <button type="submit" class="btn btn-warning">Créer le produit</button>
        <a href="produits.php" class="btn btn-dark">Retour</a>
    </form>
</div>

<?php
include("footer.php");
?>