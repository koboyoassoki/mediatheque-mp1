<?php
// Catalogue : liste des livres, avec filtre optionnel ?categorie=...
require_once __DIR__ . '/data/livres.php';
require_once __DIR__ . '/includes/fonctions.php';

$categories     = listerCategories($livres);
$categorieErreur = null;   // mémorise une catégorie invalide pour le message
$categorieActive = '';     // catégorie valide actuellement filtrée

// 1. Lecture du paramètre URL (peut être absent, vide ou être un tableau)
$param = $_GET['categorie'] ?? '';

if (is_string($param) && trim($param) !== '') {
    $demande = strtolower(trim($param));

    // 2. Validation : la catégorie doit exister dans les données
    if (in_array($demande, $categories, true)) {
        $categorieActive = $demande;
        $livresAffiches  = filtrerParCategorie($livres, $categorieActive);
    } else {
        $categorieErreur = is_string($param) ? $param : '';
        $livresAffiches  = [];
    }
} elseif (!is_string($param)) {
    // ?categorie[]=x : paramètre mal formé
    $categorieErreur = '';
    $livresAffiches  = [];
} else {
    // Pas de filtre : on affiche tout
    $livresAffiches = $livres;
}

$titrePage  = 'Catalogue';
$pageActive = 'catalogue.php';
require __DIR__ . '/includes/header.php';
?>

<h1>Catalogue</h1>

<div class="filtres">
    <ul class="filtres__liens" aria-label="Filtrer par catégorie">
        <li><a href="catalogue.php"<?= ($categorieActive === '' && $categorieErreur === null) ? ' aria-current="true"' : '' ?>>Tous</a></li>
        <?php foreach ($categories as $cat): ?>
            <li>
                <a href="catalogue.php?categorie=<?= e(urlencode($cat)) ?>"<?= $cat === $categorieActive ? ' aria-current="true"' : '' ?>>
                    <?= e(libelleCategorie($cat)) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <!-- Menu déroulant : même filtre, envoyé en GET -->
    <form class="filtres__form" action="catalogue.php" method="get">
        <label for="categorie">Catégorie</label>
        <select name="categorie" id="categorie">
            <option value="">Toutes</option>
            <?php foreach ($categories as $cat): ?>
                <option value="<?= e($cat) ?>"<?= $cat === $categorieActive ? ' selected' : '' ?>>
                    <?= e(libelleCategorie($cat)) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="bouton bouton--petit">Filtrer</button>
    </form>
</div>

<?php if ($categorieErreur !== null): ?>
    <p class="message message--erreur" role="alert">
        La catégorie «&nbsp;<?= e($categorieErreur) ?>&nbsp;» n'existe pas.
        Catégories disponibles : <?= e(implode(', ', array_map('libelleCategorie', $categories))) ?>.
    </p>
    <p><a href="catalogue.php">Revenir au catalogue complet</a></p>

<?php else: ?>
    <p class="compteur">
        <?= e(count($livresAffiches)) ?> livre<?= count($livresAffiches) > 1 ? 's' : '' ?> affiché<?= count($livresAffiches) > 1 ? 's' : '' ?>
        <?php if ($categorieActive !== ''): ?>
            dans la catégorie «&nbsp;<?= e(libelleCategorie($categorieActive)) ?>&nbsp;»
            (<a href="catalogue.php">afficher tout</a>)
        <?php endif; ?>
    </p>

    <div class="tableau-conteneur">
        <table class="tableau">
            <thead>
                <tr>
                    <th scope="col">Titre</th>
                    <th scope="col">Auteur</th>
                    <th scope="col">Année</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col" class="num">Prix</th>
                    <th scope="col">Disponibilité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($livresAffiches as $livre): ?>
                    <?= afficherLivre($livre) ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<?php require __DIR__ . '/includes/footer.php'; ?>
