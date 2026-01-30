# 🎨 Street Art Bordeaux - Site Bootstrap Cartoon Minimaliste

## ✅ Fichiers créés/modifiés

### Pages principales
- ✅ **index.php** - Page d'accueil avec hero, recherche et articles
- ✅ **articles.php** - Page liste des articles avec filtres et recherche
- ✅ **login.php** - Page de connexion
- ✅ **signup.php** - Page d'inscription
- ✅ **header.php** - Header avec navigation
- ✅ **footer.php** - Footer avec liens et réseaux sociaux

### Administration
- ✅ **views/backend/dashboard.php** - Dashboard admin redesigné avec style cartoon

### CSS
- ✅ **src/css/style.css** - Style cartoon minimaliste complet

## 🎯 Fonctionnalités implémentées

### Page Index (/)
- Hero section avec image et présentation
- Barre de recherche (mot-clé, titre, auteur)
- Aperçu des derniers articles
- Design cartoon coloré et dynamique

### Page Articles (/articles.php)
- Barre de recherche complète
- Système de filtres par catégories :
  - Tous
  - Street Art
  - Artistes
  - Culture
  - Événements
- Tri par : récent, ancien, A-Z, Z-A, popularité
- Cartes d'articles avec images et stats
- Pagination

### Pages d'authentification
- **Login** (/login.php) - Formulaire de connexion
- **Signup** (/signup.php) - Formulaire d'inscription avec validation

### Dashboard Admin (/views/backend/dashboard.php)
- Cartes de statistiques (articles, membres, commentaires, vues)
- Sections de gestion pour :
  - Articles
  - Membres
  - Commentaires
  - Mots-clés
  - Thématiques
  - Statuts
  - Likes
- Design moderne avec cartes et icônes

## 🎨 Style Cartoon Minimaliste

### Palette de couleurs
- **Primary**: #FF6B6B (Rouge corail)
- **Secondary**: #4ECDC4 (Turquoise)
- **Accent**: #FFE66D (Jaune)
- **Dark**: #2C3E50 (Bleu foncé)
- **Light**: #F7F9FC (Gris clair)

### Caractéristiques du design
- Bordures arrondies (20px)
- Ombres douces
- Animations au survol
- Polices : Fredoka (titres), Poppins (texte)
- Icônes Font Awesome
- Design responsive mobile-first

## 🔗 Redirections et Navigation

### Navigation principale (Header)
```
Accueil      → /index.php
Articles     → /articles.php
Admin        → /views/backend/dashboard.php
Connexion    → /login.php
Inscription  → /signup.php
```

### Formulaire de recherche
```
Index → /articles.php?keyword=...&title=...&author=...
```

### Dashboard Admin
```
Articles     → /views/backend/articles/list.php | create.php
Membres      → /views/backend/members/list.php | create.php
Commentaires → /views/backend/comments/list.php | create.php
Mots-clés    → /views/backend/keywords/list.php | create.php
Thématiques  → /views/backend/thematiques/list.php | create.php
Statuts      → /views/backend/statuts/list.php | create.php
Likes        → /views/backend/likes/list.php | create.php
```

### Formulaires d'authentification
```
Login  → POST /api/security/login.php
Signup → POST /api/security/signup.php
```

### Footer
```
Accueil → /index.php
Articles → /articles.php
Admin → /views/backend/dashboard.php
CGU → /views/frontend/rgpd/cgu.php
RGPD → /views/frontend/rgpd/rgpd.php
```

## 📱 Responsive

Le design est entièrement responsive avec :
- Breakpoints : 576px, 768px, 992px
- Navigation mobile avec menu hamburger
- Grilles adaptatives Bootstrap
- Images fluides
- Cartes empilées sur mobile

## 🚀 Prochaines étapes

Pour connecter le site à votre base de données :

1. **Connexion BDD** : Adapter les appels dans chaque page
2. **Récupération articles** : Utiliser `getArticles()` dans index.php et articles.php
3. **Recherche** : Implémenter la logique de recherche et filtrage
4. **Authentification** : Compléter les fichiers API login/signup
5. **Dashboard stats** : Récupérer les vraies statistiques
6. **Upload images** : Remplacer les images Unsplash par vos uploads

## 🎯 Points clés

✅ Design cartoon minimaliste et coloré
✅ Navigation cohérente avec bonnes redirections
✅ Système de recherche et filtres fonctionnel (front)
✅ Dashboard admin moderne et intuitif
✅ Pages d'authentification complètes
✅ 100% responsive
✅ Animations et interactions
✅ Structure claire et maintenable
