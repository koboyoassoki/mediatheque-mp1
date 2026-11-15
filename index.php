<?php
// Page d'accueil : bienvenue, lien vers le catalogue, nombre de livres.
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

$totalLivres = count($livres);
$disponibles = compterLivresDisponibles($livres);

$titrePage  = 'Accueil';
$pageActive = 'index.php';
require __DIR__ . '/includes/header.php';
?>

<section class="hero">
    <h1>Bienvenue à la médiathèque IPNET</h1>
    <p class="hero__texte">
        Romans, science-fiction, histoire, informatique : parcourez notre catalogue
        et trouvez votre prochaine lecture.
    </p>
    <p><a class="bouton" href="catalogue.php">Voir le catalogue</a></p>
</section>

<section class="chiffres" aria-label="Chiffres du catalogue">
    <p class="chiffre">
        <span class="chiffre__valeur"><?= e($totalLivres) ?></span>
        livres au catalogue
    </p>
    <p class="chiffre">
        <span class="chiffre__valeur"><?= e($disponibles) ?></span>
        livres disponibles aujourd'hui
    </p>
</section>

<?php require __DIR__ . '/includes/footer.php'; ?>
