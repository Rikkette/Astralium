<!------Page portefolio ou gallery pour presenter le travail d'illustration de marion aux internautes ------->
<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--liens /script des librairies JavaScript pour fancybox -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<!--Ajoutez des transitions "swing" et "linéaire"-->
<script type="text/javascript" src="/fancybox/jquery.easing-1.4.pack.js"></script>
<!-- Active la molette de la souris pour naviguer dans la galerie.--->
<script type="text/javascript" src="/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

<h1 class="titre_portefolio">
    Bienvenue sur mon Portfolio
</h1>

<!--------Récupération des images depuis la base de données------>
<?php
$sql = "SELECT m.*, p.produits_nom 
        FROM Media m 
        LEFT JOIN produits p ON m.produits_id = p.produits_id 
        ORDER BY m.media_id DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-------------------------- Partie bootstrap ----------------------------->
<div class="container py-5">
    <div class="row">
        <?php foreach ($images as $image): ?>
            <div class="col-md-4 col-sm-6 mb-4">
                <div class="portfolio-item">
                    <?php
                    // Utilisation d'une extension stockée ou par défaut jpg
                    $extension = !empty($image['media_extension']) ? $image['media_extension'] : 'jpg';
                    $imagePath = "uploads/" . $image['media_id'] . "." . $extension;
                    ?>
                    <a href="<?= htmlspecialchars($imagePath) ?>" data-fancybox="gallery"
                        data-caption="<?= htmlspecialchars($image['produits_nom'] ?? 'Image') ?>">
                        <img src="<?= htmlspecialchars($imagePath) ?>" class="img-fluid rounded"
                            alt="<?= htmlspecialchars($image['produits_nom'] ?? 'Image') ?>">
                    </a>
                    <?php if (isset($image['produits_nom'])): ?>
                        <div class="mt-2"><?= htmlspecialchars($image['produits_nom']) ?></div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<!--------------------- Initialisation de la bibliotheque Fancybox ------------>
<link rel="stylesheet" href="/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script>
    $(document).ready(function() {
        Fancybox.bind('[data-fancybox]', {
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