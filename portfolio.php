<!------Page portefolio ou gallery pour presenter le travail d'illustration de marion aux internautes ------->
<?php
include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!------------------------------ jquery --------------------------------->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!---------------------------liens fichier fancybox ------------------------->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
<!------------- option: transition « swing » et « linéaire » -------->
<script type="text/javascript" src="/fancybox/jquery.easing-1.4.pack.js"></script>
<!------ option: Active la molette de la souris pour naviguer dans la galerie ----->
<script type="text/javascript" src="/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>

<h1 class="titre_portefolio">
    Bienvenue sur mon Portfolio
</h1>
<section class="Calendrier_2025">
    <!---Calendrier Janvier 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_01_Janvier.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_01_Janvier.png" alt="Calendrier Janvier" style="width:400px;">
    </a>
    <!---Calendrier Février 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_02_Février.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_02_Février.png" alt="Calendrier Février" style="width:400px;">
    </a>
    <!---Calendrier Mars 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_03_Mars.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_03_Mars.png" alt="Calendrier Mars" style="width:400px;">
    </a>
    <!---Calendrier Avril 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_04_Avril.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_04_Avril.png" alt="Calendrier Avril" style="width:400px;">
    </a>
    <!---Calendrier Mai 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_05_Mai.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_05_Mai.png" alt="Calendrier Mai" style="width:400px;">
    </a>
     <!---Calendrier Juin 2025 --->
     <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_06_Juin.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_06_Juin.png" alt="Calendrier Juin" style="width:400px;">
    </a>
     <!---Calendrier Juillet 2025 --->
     <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_07_Juillet.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_07_Juillet.png" alt="Calendrier Juillet" style="width:400px;">
    </a>
     <!---Calendrier Aout 2025 --->
     <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_08_Août.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_08_Août.png" alt="Calendrier Aout" style="width:400px;">
    </a>
    <!---Calendrier Septembre 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_09_Septembre.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_09_Septembre.png" alt="Calendrier Septembre" style="width:400px;">
    </a>
    <!---Calendrier Octobre 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_10_Octobre.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_10_Octobre.png" alt="Calendrier Octobre" style="width:400px;">
    </a>
    <!---Calendrier Novembre 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_11_Novembre.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_11_Novembre.png" alt="Calendrier Novembre" style="width:400px;">
    </a>
    <!---Calendrier Décembre 2025 --->
    <a class="groupe_calendrier_2025" rel="Calendrier_2025" href="/Style/calendrier_fr/Calendrier_12_Décembre.png" data-fancybox="gallery">
        <img src="Style/calendrier_fr/Calendrier_12_Décembre.png" alt="Calendrier Décembre" style="width:400px;">
    </a>

</section>
<!-----------------------partie fancybox ------------------->
<script>
    $(document).ready(function() {
        $("[data-fancybox]").fancybox({

            loop: true,
            buttons: [
                "zoom",
                "share",
                "slideShow",
                "fullScreen",
                "download",
                "thumbs",
                "close"
            ],
            animationEffect: "zoom",
            transitionEffect: "slide"
        });
    });
</script>

<?php include 'footer.php'; ?>