<?php
// Page statique « À propos » avec la date du jour générée par une fonction.
require_once __DIR__ . '/includes/fonctions.php';

$titrePage  = 'À propos';
$pageActive = 'apropos.php';
require __DIR__ . '/includes/header.php';
?>

<h1>À propos de la médiathèque</h1>

<p>
    La médiathèque IPNET met à la disposition des étudiants et du personnel une
    collection de livres couvrant la littérature, les sciences et l'informatique.
</p>
<p>
    Ce site est un premier prototype : le catalogue est stocké dans un simple
    tableau PHP, sans base de données. Il sera enrichi dans les prochaines étapes
    du cours.
</p>

<p class="message message--info">Nous sommes le <?= e(dateDuJour()) ?>.</p>

<?php require __DIR__ . '/includes/footer.php'; ?>
