<?php
/**
 * includes/header.php
 * En-tête commun. Variables attendues (définies avant l'include) :
 *   $titrePage  : titre de l'onglet
 *   $pageActive : nom du fichier courant, pour surligner le menu
 */
$titrePage  = $titrePage  ?? 'Médiathèque IPNET';
$pageActive = $pageActive ?? '';

$menu = [
    'index.php'     => 'Accueil',
    'catalogue.php' => 'Catalogue',
    'apropos.php'   => 'À propos',
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e($titrePage) ?> | Médiathèque IPNET</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header class="entete">
    <div class="conteneur entete__contenu">
        <a class="logo" href="index.php">Médiathèque <strong>IPNET</strong></a>
        <nav aria-label="Navigation principale">
            <ul class="menu">
                <?php foreach ($menu as $fichier => $libelle): ?>
                    <li>
                        <a href="<?= e($fichier) ?>"<?= $fichier === $pageActive ? ' aria-current="page"' : '' ?>>
                            <?= e($libelle) ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </div>
</header>
<main class="conteneur">
