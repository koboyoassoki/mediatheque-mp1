<?php
// Détail d'un livre : detail.php?id=3
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

$livre  = null;
$erreur = null;

// 1. Identifiant absent ?
if (!isset($_GET['id']) || $_GET['id'] === '') {
    $erreur = "Aucun identifiant de livre n'a été fourni.";
    http_response_code(400);
} else {
    // 2. Identifiant entier valide ? (filter_var renvoie false sinon)
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

    if ($id === false) {
        $erreur = "L'identifiant doit être un nombre entier.";
        http_response_code(400);
    } else {
        // 3. Identifiant existant ?
        $livre = trouverLivreParId($livres, $id);
        if ($livre === null) {
            $erreur = "Aucun livre ne correspond à l'identifiant " . $id . '.';
            http_response_code(404);
        }
    }
}

$titrePage  = $livre !== null ? $livre['titre'] : 'Livre introuvable';
$pageActive = 'catalogue.php';
require __DIR__ . '/includes/header.php';
?>

<p class="fil"><a href="catalogue.php">&larr; Retour au catalogue</a></p>

<?php if ($erreur !== null): ?>
    <h1>Livre introuvable</h1>
    <p class="message message--erreur" role="alert"><?= e($erreur) ?></p>
    <p><a class="bouton" href="catalogue.php">Voir tous les livres</a></p>

<?php else: ?>
    <article class="fiche">
        <h1><?= e($livre['titre']) ?></h1>
        <p class="fiche__auteur">de <?= e($livre['auteur']) ?></p>

        <dl class="fiche__infos">
            <div><dt>Identifiant</dt><dd><?= e($livre['id']) ?></dd></div>
            <div><dt>Année de publication</dt><dd><?= e($livre['annee']) ?></dd></div>
            <div>
                <dt>Catégorie</dt>
                <dd>
                    <a href="catalogue.php?categorie=<?= e(urlencode($livre['categorie'])) ?>">
                        <?= e(libelleCategorie($livre['categorie'])) ?>
                    </a>
                </dd>
            </div>
            <div><dt>Prix</dt><dd><?= e(formaterPrix($livre['prix'])) ?></dd></div>
            <div><dt>Disponibilité</dt><dd><?= badgeDisponibilite((bool) $livre['disponible']) ?></dd></div>
        </dl>
    </article>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
