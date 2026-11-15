# Médiathèque IPNET : catalogue dynamique (MP1)

Mini-projet du cours de PHP (IT231), chargé de cours : M. EDOU Dodji.

## Description

Premier site web de la médiathèque IPNET. Il affiche un catalogue de livres
généré dynamiquement avec PHP. Aucune base de données n'est utilisée : les
livres sont stockés dans un tableau associatif (`data/livres.php`).

## Prérequis

- PHP 8.0 ou plus récent (PHP natif, XAMPP, WAMP ou MAMP)
- Un navigateur web
- Git (pour récupérer le dépôt)

Vérifier la version de PHP : `php -v`

## Installation et lancement

### Avec le serveur intégré de PHP

```bash
git clone <url-du-depot>
cd mediatheque-mp1
php -S localhost:8000
```

Puis ouvrir <http://localhost:8000>.

### Avec XAMPP / WAMP / MAMP

1. Copier le dossier `mediatheque-mp1` dans `htdocs` (XAMPP, MAMP) ou `www` (WAMP).
2. Démarrer Apache.
3. Ouvrir <http://localhost/mediatheque-mp1/>.

## Structure

```
mediatheque-mp1/
├── index.php          Accueil, nombre total de livres
├── catalogue.php      Liste des livres + filtre par catégorie
├── detail.php         Fiche d'un livre (?id=3)
├── apropos.php        Présentation + date du jour
├── includes/
│   ├── header.php     En-tête et menu communs
│   ├── footer.php     Pied de page commun
│   └── fonctions.php  Fonctions utilitaires
├── data/livres.php    Tableau $livres (10 livres)
├── css/style.css      Mise en forme
└── README.md
```

## Fonctionnalités réalisées

- Page d'accueil : bienvenue, lien vers le catalogue, total des livres et
  nombre de livres disponibles calculés depuis le tableau.
- Catalogue en tableau HTML (titre, auteur, année, catégorie, prix,
  disponibilité) avec compteur de livres affichés.
- Filtrage par catégorie (`catalogue.php?categorie=roman`) via liens et menu
  déroulant, validation du paramètre, message d'erreur si la catégorie
  n'existe pas, lien pour revenir au catalogue complet.
- Page détail (`detail.php?id=3`) : vérification de l'identifiant (absent,
  non numérique, inexistant) avec message d'erreur propre et code HTTP adapté.
- Page « À propos » avec la date du jour en français via `dateDuJour()`.
- Fonctions requises : `afficherLivre`, `filtrerParCategorie`,
  `trouverLivreParId`, `compterLivresDisponibles`.
- Toutes les données affichées passent par `htmlspecialchars()` (raccourci `e()`).
- Mise en page adaptée aux petits écrans.
