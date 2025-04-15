<?php
include 'header.php';


// Initialisation des variables
$search = isset($_GET['searchCat']) ? $_GET['searchCat'] : '';
$category = isset($_GET['category']) ? $_GET['category'] : '';


// Requête SQL pour récupérer les produits
$sql = "SELECT p.*, c.*, m.media_id, m.media_libelle  
        FROM produits p 
        JOIN categories c ON p.categorie_id = c.categorie_id
        LEFT JOIN Media m ON p.produits_id = m.produits_id";
// Ajout des filtres de recherche et catégorie
$whereClause = [];
$params = [];

if (!empty($search)) {
    $whereClause[] = "p.produits_nom LIKE :search";
    $params[':search'] = "%$search%";
}

if (!empty($category)) {
    $whereClause[] = "c.categorie_nom = :category";
    $params[':category'] = $category;
}

if (!empty($whereClause)) {
    $sql .= " WHERE " . implode(" AND ", $whereClause);
}

// Exécution de la requête
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Suppression d'un produit
if (isset($_GET['delete'])) {
    $deleteID = $_GET['delete'];
    $stmt = $pdo->prepare("SELECT produits_id FROM produits WHERE produits_id = :id");
    $stmt->execute([':id' => $deleteID]);
    $produit = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($produit) {
        $deleteSql = "DELETE FROM produits WHERE produits_id = :id";
        $stmt = $pdo->prepare($deleteSql);
        $stmt->execute([':id' => $deleteID]);
    }
    header('Location: produits.php');
    exit;
}
?>

<h1 class="titre_boutique">
    Bienvenue sur ma Boutique
</h1>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <p class="text-center text-bg-danger"><?php if (isset($message)) echo $message; ?></p>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($produits as $produit): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image-->
                        <img class="card-img-top" src="uploads/<?= htmlentities($produit['media_libelle']) ?>" alt="Photo du produit" />
                        <!-- Product details-->
                        <div class="card-body m-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <h5 class="fw-bolder"><?= htmlentities($produit['produits_nom']) ?></h5>
                                <?= htmlentities($produit['nombre_pieces'] ?? '') ?> pièces.
                                <br>
                                <hr>
                                <!-- Product price-->
                                <?= number_format($produit['produits_prix'], 2) ?> €.
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer m-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="produit-details.php?id=<?= htmlentities($produit['produits_id']) ?>">En savoir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include 'footer.php';
?>