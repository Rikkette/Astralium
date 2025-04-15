<?php
include "header.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

<h1 class="titre_portefolio">
    Bienvenue sur mon Portfolio
</h1>

<?php
$sql = "SELECT m.*, p.produits_nom 
        FROM Media m 
        LEFT JOIN produits p ON m.produits_id = p.produits_id 
        ORDER BY m.media_id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container py-5">
    
    <div class="row">
        <?php foreach ($images as $image): ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <a href="uploads/<?= $image['media_id'] ?>.jpg" data-fancybox="gallery" 
                       data-caption="<?= htmlentities($image['produits_nom'] ?? 'Image') ?>">
                        <img src="uploads/<?= $image['media_id'] ?>.jpg" class="img-fluid rounded" 
                             alt="<?= htmlentities($image['produits_nom'] ?? 'Image') ?>">
                    </a>
                    <?php if (isset($image['produits_nom'])): ?>
                        <div class="mt-2"><?= htmlentities($image['produits_nom']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Initialisation de Fancybox
        $('[data-fancybox]').fancybox({
            buttons: [
                "zoom",
                "slideShow",
                "fullScreen",
                "download",
                "thumbs",
                "close"
            ],
            loop: true
        });
    });
</script>

<?php include 'footer.php'; ?>

</body>