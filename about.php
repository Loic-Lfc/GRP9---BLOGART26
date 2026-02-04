<?php
require_once 'header.php';
?>

<!-- Hero Section -->
<section class="hero-section text-white">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto text-center">
        <h1 class="display-3 fw-bold mb-4" style="font-family: var(--font-title); letter-spacing: 3px;">
          À PROPOS
        </h1>
        <div style="width: 100px; height: 4px; background: var(--color-primary); margin: 0 auto 2rem; border-radius: 2px;"></div>
        <p class="lead" style="font-size: 1.3rem; color: var(--color-text-secondary);">
          Découvrez l'histoire et la mission de Murmures Bordeaux
        </p>
      </div>
    </div>
  </div>
</section>

<!-- About Content -->
<section class="py-5" style="background: var(--color-dark);">
  <div class="container">
    <div class="row">
      <div class="col-lg-10 mx-auto">
        
        <!-- Notre Mission -->
        <div class="mb-5 p-5" style="background: var(--color-card); border-radius: var(--radius); box-shadow: var(--shadow); border-left: 5px solid var(--color-primary);">
          <div class="row align-items-center">
            <div class="col-md-2 text-center mb-3 mb-md-0">
              <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--color-primary), var(--color-accent)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                <i class="fas fa-bullseye" style="font-size: 2rem; color: var(--color-white);"></i>
              </div>
            </div>
            <div class="col-md-10">
              <h2 style="font-family: var(--font-title); color: var(--color-white); font-size: 2rem; margin-bottom: 1rem;">
                Notre Mission
              </h2>
              <p style="color: var(--color-text-secondary); font-size: 1.1rem; line-height: 1.8; margin: 0;">
                <strong style="color: var(--color-white);">Murmures Bordeaux</strong> est né de la passion pour l'art urbain et la culture street art qui anime les rues de Bordeaux. Notre mission est de donner une voix aux artistes de rue, de documenter leurs œuvres éphémères et de partager avec vous l'histoire derrière chaque fresque, chaque tag, chaque murale qui transforme notre ville en galerie à ciel ouvert.
              </p>
            </div>
          </div>
        </div>

        <!-- Notre Histoire -->
        <div class="mb-5 p-5" style="background: var(--color-card); border-radius: var(--radius); box-shadow: var(--shadow); border-left: 5px solid var(--color-accent);">
          <div class="row align-items-center">
            <div class="col-md-2 text-center mb-3 mb-md-0">
              <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--color-accent), var(--color-secondary)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                <i class="fas fa-book-open" style="font-size: 2rem; color: var(--color-white);"></i>
              </div>
            </div>
            <div class="col-md-10">
              <h2 style="font-family: var(--font-title); color: var(--color-white); font-size: 2rem; margin-bottom: 1rem;">
                Notre Histoire
              </h2>
              <p style="color: var(--color-text-secondary); font-size: 1.1rem; line-height: 1.8; margin: 0;">
                Fondé en 2026, <strong style="color: var(--color-white);">Murmures Bordeaux</strong> est devenu la référence pour tous les passionnés de street art dans la région bordelaise. Ce qui a commencé comme un simple blog photographique s'est transformé en une véritable plateforme communautaire où artistes, amateurs et curieux se retrouvent pour célébrer cet art qui fait vibrer nos quartiers.
              </p>
            </div>
          </div>
        </div>

        <!-- Ce que nous faisons -->
        <div class="mb-5">
          <h2 class="text-center mb-5" style="font-family: var(--font-title); color: var(--color-white); font-size: 2.5rem; text-transform: uppercase; letter-spacing: 2px;">
            Ce que nous faisons
          </h2>
          <div class="row g-4">
            <div class="col-md-4">
              <div class="text-center p-4" style="background: var(--color-card); border-radius: var(--radius); box-shadow: var(--shadow); height: 100%; border-top: 4px solid var(--color-primary); transition: var(--transition);">
                <div style="width: 70px; height: 70px; background: rgba(109, 7, 26, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                  <i class="fas fa-camera-retro" style="font-size: 2rem; color: var(--color-primary);"></i>
                </div>
                <h3 style="font-family: var(--font-title); color: var(--color-white); font-size: 1.3rem; margin-bottom: 1rem;">
                  Documentation
                </h3>
                <p style="color: var(--color-text-secondary); line-height: 1.6;">
                  Nous photographions et documentons les œuvres de street art à travers Bordeaux, créant une archive vivante de l'art urbain local.
                </p>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="text-center p-4" style="background: var(--color-card); border-radius: var(--radius); box-shadow: var(--shadow); height: 100%; border-top: 4px solid var(--color-accent); transition: var(--transition);">
                <div style="width: 70px; height: 70px; background: rgba(168, 0, 28, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                  <i class="fas fa-pen-fancy" style="font-size: 2rem; color: var(--color-accent);"></i>
                </div>
                <h3 style="font-family: var(--font-title); color: var(--color-white); font-size: 1.3rem; margin-bottom: 1rem;">
                  Articles
                </h3>
                <p style="color: var(--color-text-secondary); line-height: 1.6;">
                  Nous rédigeons des articles approfondis sur les artistes, les techniques et l'histoire du street art bordelais.
                </p>
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="text-center p-4" style="background: var(--color-card); border-radius: var(--radius); box-shadow: var(--shadow); height: 100%; border-top: 4px solid var(--color-secondary); transition: var(--transition);">
                <div style="width: 70px; height: 70px; background: rgba(74, 5, 17, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                  <i class="fas fa-users" style="font-size: 2rem; color: var(--color-secondary);"></i>
                </div>
                <h3 style="font-family: var(--font-title); color: var(--color-white); font-size: 1.3rem; margin-bottom: 1rem;">
                  Communauté
                </h3>
                <p style="color: var(--color-text-secondary); line-height: 1.6;">
                  Nous créons des ponts entre artistes et amateurs, favorisant les échanges et la découverte de nouveaux talents.
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Notre Vision -->
        <div class="mb-5 p-5 text-center" style="background: linear-gradient(135deg, var(--color-card), rgba(109, 7, 26, 0.1)); border-radius: var(--radius); box-shadow: var(--shadow-hover); border: 2px solid var(--color-primary);">
          <div style="width: 100px; height: 100px; background: linear-gradient(135deg, var(--color-primary), var(--color-accent)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem;">
            <i class="fas fa-eye" style="font-size: 3rem; color: var(--color-white);"></i>
          </div>
          <h2 style="font-family: var(--font-title); color: var(--color-white); font-size: 2rem; margin-bottom: 1.5rem;">
            Notre Vision
          </h2>
          <p style="color: var(--color-white); font-size: 1.2rem; line-height: 1.8; max-width: 800px; margin: 0 auto;">
            Faire de Bordeaux une ville reconnue pour son street art, où chaque mur raconte une histoire et où l'art urbain est célébré comme une forme d'expression légitime et précieuse. Nous rêvons d'un espace où l'art de la rue inspire, questionne et rassemble.
          </p>
        </div>

        <!-- Rejoignez-nous -->
        <div class="text-center p-5" style="background: var(--color-card); border-radius: var(--radius); box-shadow: var(--shadow);">
          <h2 style="font-family: var(--font-title); color: var(--color-white); font-size: 2.5rem; margin-bottom: 1.5rem; text-transform: uppercase;">
            Rejoignez l'Aventure
          </h2>
          <p style="color: var(--color-text-secondary); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem; max-width: 700px; margin-left: auto; margin-right: auto;">
            Que vous soyez artiste, photographe, écrivain ou simplement passionné de street art, vous avez votre place dans notre communauté. Partagez vos découvertes, contribuez à nos articles, et participez à faire vivre le street art bordelais !
          </p>
          <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="/articles.php" class="btn-cartoon" style="display: inline-flex; align-items: center; gap: 0.5rem;">
              <i class="fas fa-palette"></i>
              <span>Découvrir les articles</span>
            </a>
            <a href="/views/backend/security/signup.php" class="btn-cartoon-outline" style="display: inline-flex; align-items: center; gap: 0.5rem;">
              <i class="fas fa-user-plus"></i>
              <span>Rejoindre la communauté</span>
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<?php include 'footer.php'; ?>
