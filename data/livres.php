<?php
/**
 * data/livres.php
 * Données du catalogue : aucune base de données, tout est stocké dans un
 * tableau associatif PHP. Chaque livre possède les clés :
 * id, titre, auteur, annee, categorie, prix (en FCFA), disponible (bool).
 * La clé "categorie" est un "slug" en minuscules utilisé dans l'URL.
 */
$livres = [
    ['id' => 1,  'titre' => 'Les Soleils des indépendances', 'auteur' => 'Ahmadou Kourouma', 'annee' => 1968, 'categorie' => 'roman',           'prix' => 6500,  'disponible' => true],
    ['id' => 2,  'titre' => 'Une si longue lettre',          'auteur' => 'Mariama Bâ',        'annee' => 1979, 'categorie' => 'roman',           'prix' => 5500,  'disponible' => true],
    ['id' => 3,  'titre' => "L'Enfant noir",                 'auteur' => 'Camara Laye',       'annee' => 1953, 'categorie' => 'roman',           'prix' => 5000,  'disponible' => false],
    ['id' => 4,  'titre' => 'Dune',                          'auteur' => 'Frank Herbert',     'annee' => 1965, 'categorie' => 'science-fiction', 'prix' => 9000,  'disponible' => true],
    ['id' => 5,  'titre' => 'Fondation',                     'auteur' => 'Isaac Asimov',      'annee' => 1951, 'categorie' => 'science-fiction', 'prix' => 7500,  'disponible' => true],
    ['id' => 6,  'titre' => 'Sapiens : une brève histoire de l\'humanité', 'auteur' => 'Yuval Noah Harari', 'annee' => 2011, 'categorie' => 'histoire', 'prix' => 12000, 'disponible' => true],
    ['id' => 7,  'titre' => 'Clean Code',                    'auteur' => 'Robert C. Martin',  'annee' => 2008, 'categorie' => 'informatique',    'prix' => 25000, 'disponible' => false],
    ['id' => 8,  'titre' => 'Eloquent JavaScript',           'auteur' => 'Marijn Haverbeke',  'annee' => 2011, 'categorie' => 'informatique',    'prix' => 18000, 'disponible' => true],
    ['id' => 9,  'titre' => 'Le Petit Prince',               'auteur' => 'Antoine de Saint-Exupéry', 'annee' => 1943, 'categorie' => 'jeunesse', 'prix' => 4000,  'disponible' => true],
    ['id' => 10, 'titre' => 'Le Vieux Nègre et la médaille', 'auteur' => 'Ferdinand Oyono',   'annee' => 1956, 'categorie' => 'roman',           'prix' => 5000,  'disponible' => true],
];
