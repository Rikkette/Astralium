<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Accueil</title>
</head>

<body>
    <div class="banniere-container">
        <div>
            <img src="/Style/photo_illu/banniere_index.png" class="banniere_index">
        </div>
    </div>

    <?php
    $sql = "SELECT p.* FROM produits p ORDER BY produits_id DESC LIMIT 4";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $derniers_produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="mb-4">Nos dernières nouveautés</h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php foreach ($derniers_produits as $produit): ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Product image -->
                        <img class="card-img-top" src="uploads/default.jpg" alt="Photo du produit" />
                        
                        <!-- Product details -->
                        <div class="card-body m-4">
                            <div class="text-center">
                                <!-- Product name -->
                                <h5 class="fw-bolder"><?= htmlentities($produit['produits_nom']) ?></h5>
                                <hr>
                                <!-- Product price -->
                                <?= number_format($produit['produits_prix'], 2) ?> €
                            </div>
                        </div>
                        
                        <!-- Product actions -->
                        <div class="card-footer m-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="produit-details.php?id=<?= htmlentities($produit['produits_id']) ?>">En savoir plus</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="text-center mt-4">
            <a class="btn btn-primary" href="produits.php">Voir tous nos produits</a>
        </div>
    </div>
</section>

<?php
include "footer.php";
?>

</html>
</body>