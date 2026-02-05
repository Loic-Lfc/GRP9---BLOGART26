<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Politique de confidentialité - Murmures Bordeaux</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/src/css/style.css">
    <style>
        body {
            background: var(--color-dark, #0A0A0A);
            color: var(--color-text, #FFFFFF);
            padding: 2rem 0;
        }
        .close-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            background: var(--color-primary, #E31E24);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        .close-btn:hover {
            background: var(--color-secondary, #B71C1C);
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <button class="close-btn" onclick="window.close();" title="Fermer">
        <i class="fas fa-times"></i>
    </button>

    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <div class="article-card">
                    <div class="article-body">
                        <h1 class="text-center mb-4" style="font-family: var(--font-title); color: var(--color-white);">
                            <i class="fas fa-shield-alt me-2"></i>Politique de confidentialité (RGPD)
                        </h1>
                        
                        <h2 class="article-title mt-4">
                            <i class="fas fa-info-circle me-2"></i>1. Collecte des données
                        </h2>
                        <p>
                            Dans le cadre de l'utilisation de notre site <strong>Murmures Bordeaux</strong>, nous collectons les données personnelles suivantes :
                        </p>
                        <ul>
                            <li>Nom, prénom et pseudo</li>
                            <li>Adresse email</li>
                            <li>Mot de passe (crypté)</li>
                            <li>Dates de création et modification du compte</li>
                        </ul>

                        <h2 class="article-title">
                            <i class="fas fa-database me-2"></i>2. Utilisation des données
                        </h2>
                        <p>
                            Vos données personnelles sont utilisées pour :
                        </p>
                        <ul>
                            <li>Gérer votre compte utilisateur</li>
                            <li>Permettre la publication d'articles et de commentaires</li>
                            <li>Assurer la sécurité du site</li>
                            <li>Vous contacter concernant votre compte ou vos publications</li>
                        </ul>

                        <h2 class="article-title">
                            <i class="fas fa-cookie-bite me-2"></i>3. Cookies
                        </h2>
                        <p>
                            Notre site utilise des cookies pour améliorer votre expérience de navigation :
                        </p>
                        <ul>
                            <li><strong>Cookies de session :</strong> Nécessaires pour la connexion et l'utilisation du site</li>
                            <li><strong>Cookies de consentement :</strong> Pour mémoriser votre choix concernant l'utilisation des cookies</li>
                            <li><strong>Cookies de sécurité :</strong> Pour protéger votre compte et prévenir les accès non autorisés</li>
                        </ul>
                        <p>
                            Vous pouvez à tout moment refuser ou supprimer les cookies via les paramètres de votre navigateur.
                        </p>

                        <h2 class="article-title">
                            <i class="fas fa-lock me-2"></i>4. Protection des données
                        </h2>
                        <p>
                            Nous mettons en œuvre toutes les mesures techniques et organisationnelles appropriées pour protéger vos données personnelles contre :
                        </p>
                        <ul>
                            <li>La destruction accidentelle ou illicite</li>
                            <li>La perte accidentelle</li>
                            <li>L'altération, la diffusion ou l'accès non autorisé</li>
                        </ul>

                        <h2 class="article-title">
                            <i class="fas fa-user-check me-2"></i>5. Vos droits
                        </h2>
                        <p>
                            Conformément au RGPD, vous disposez des droits suivants :
                        </p>
                        <ul>
                            <li><strong>Droit d'accès :</strong> Vous pouvez demander l'accès à vos données personnelles</li>
                            <li><strong>Droit de rectification :</strong> Vous pouvez modifier vos informations</li>
                            <li><strong>Droit à l'effacement :</strong> Vous pouvez demander la suppression de votre compte</li>
                            <li><strong>Droit à la portabilité :</strong> Vous pouvez récupérer vos données</li>
                            <li><strong>Droit d'opposition :</strong> Vous pouvez vous opposer au traitement de vos données</li>
                        </ul>

                        <h2 class="article-title">
                            <i class="fas fa-clock me-2"></i>6. Conservation des données
                        </h2>
                        <p>
                            Vos données personnelles sont conservées aussi longtemps que votre compte est actif. Après suppression de votre compte, vos données sont effacées sous 30 jours maximum.
                        </p>

                        <h2 class="article-title">
                            <i class="fas fa-envelope me-2"></i>7. Contact
                        </h2>
                        <p>
                            Pour toute question concernant vos données personnelles ou pour exercer vos droits, vous pouvez nous contacter à l'adresse suivante :
                        </p>
                        <p class="mb-0">
                            <strong>Email :</strong> contact@murmuresbordeaux.fr<br>
                            <strong>Adresse :</strong> Murmures Bordeaux, Bordeaux, France
                        </p>

                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i>
                            Dernière mise à jour : <?php echo date('d/m/Y'); ?>
                        </div>

                        <div class="text-center mt-4">
                            <button onclick="window.close();" class="btn-cartoon">
                                <i class="fas fa-times me-2"></i>Fermer cette fenêtre
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
