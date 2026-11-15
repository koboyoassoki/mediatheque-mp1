<?php
/**
 * includes/fonctions.php
 * Fonctions utilitaires partagées par toutes les pages.
 */

/**
 * Échappe une valeur avant affichage (protection contre les failles XSS).
 */
function e(string|int|float $valeur): string
{
    return htmlspecialchars((string) $valeur, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

/**
 * Formate un prix en FCFA (ex. 6500 => "6 500 FCFA").
 */
function formaterPrix(int|float $prix): string
{
    return number_format($prix, 0, ',', ' ') . ' FCFA';
}

/**
 * Transforme un slug de catégorie en libellé lisible
 * (ex. "science-fiction" => "Science fiction").
 */
function libelleCategorie(string $slug): string
{
    return ucfirst(str_replace('-', ' ', $slug));
}

/**
 * Retourne le HTML du badge de disponibilité.
 */
function badgeDisponibilite(bool $disponible): string
{
    return $disponible
        ? '<span class="badge badge--oui">Disponible</span>'
        : '<span class="badge badge--non">Emprunté</span>';
}

/**
 * Retourne une ligne de tableau HTML (<tr>) pour un livre.
 * Toutes les données issues du tableau passent par htmlspecialchars().
 */
function afficherLivre(array $livre): string
{
    $html  = '<tr>';
    $html .= '<td data-label="Titre"><a href="detail.php?id=' . e($livre['id']) . '">' . e($livre['titre']) . '</a></td>';
    $html .= '<td data-label="Auteur">' . e($livre['auteur']) . '</td>';
    $html .= '<td data-label="Année">' . e($livre['annee']) . '</td>';
    $html .= '<td data-label="Catégorie"><a class="lien-discret" href="catalogue.php?categorie=' . e(urlencode($livre['categorie'])) . '">'
           . e(libelleCategorie($livre['categorie'])) . '</a></td>';
    $html .= '<td data-label="Prix" class="num">' . e(formaterPrix($livre['prix'])) . '</td>';
    $html .= '<td data-label="Disponibilité">' . badgeDisponibilite((bool) $livre['disponible']) . '</td>';
    $html .= '</tr>';

    return $html;
}

/**
 * Retourne uniquement les livres appartenant à la catégorie donnée.
 * array_values() réindexe le tableau résultat à partir de 0.
 */
function filtrerParCategorie(array $livres, string $categorie): array
{
    return array_values(array_filter(
        $livres,
        fn (array $livre): bool => $livre['categorie'] === $categorie
    ));
}

/**
 * Cherche un livre par son identifiant.
 * Retourne le livre, ou null s'il n'existe pas.
 */
function trouverLivreParId(array $livres, int $id): ?array
{
    foreach ($livres as $livre) {
        if ($livre['id'] === $id) {
            return $livre;
        }
    }
    return null;
}

/**
 * Compte les livres dont la clé "disponible" vaut true.
 */
function compterLivresDisponibles(array $livres): int
{
    $total = 0;
    foreach ($livres as $livre) {
        if ($livre['disponible']) {
            $total++;
        }
    }
    return $total;
}

/**
 * Retourne la liste (sans doublon, triée) des catégories présentes.
 */
function listerCategories(array $livres): array
{
    $categories = array_unique(array_column($livres, 'categorie'));
    sort($categories);
    return $categories;
}

/**
 * Retourne la date du jour en français (ex. "samedi 14 novembre 2026").
 * Écrit à la main pour ne pas dépendre de l'extension intl.
 */
function dateDuJour(): string
{
    $jours = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
    $mois  = ['', 'janvier', 'février', 'mars', 'avril', 'mai', 'juin',
              'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

    $maintenant = new DateTimeImmutable('now', new DateTimeZone('Africa/Lome'));

    return $jours[(int) $maintenant->format('w')] . ' '
         . $maintenant->format('j') . ' '
         . $mois[(int) $maintenant->format('n')] . ' '
         . $maintenant->format('Y');
}
