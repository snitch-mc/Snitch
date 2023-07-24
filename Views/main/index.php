<?php
$title = "Accueil";
$description = "Signalez, protégez, jouez. La plateforme essentielle pour les administrateurs de serveurs Minecraft. Pour une communauté francophone Minecraft plus sûre et agréable.";

?>
<div class="hero">
    <video autoplay loop muted plays-inline disablePictureInPicture class="hero-video" playsinline webkit-playsinline>
        <source src="/assets/videos/bg.mp4" type="video/mp4">
        <source src="/assets/videos/bg.webm" type="video/webm">
        Votre navigateur ne supporte pas la lecture de cette vidéo.
    </video>
    <div class="hero-text">
        <p class="hero-title">SNITCH</p>
        <p class="hero-description">Signalez, protégez, jouez. La plateforme essentielle pour les administrateurs de serveurs.</p>
        <p class="hero-description">Vers une communauté francophone Minecraft plus sûre et agréable.</p>
        <p class="hero-description" style="margin-top: 50px; font-style: italic;">Informations</p>
        <p class="hero-description" style="margin-top: 5px; font-style: italic;">« Le site est actuellement en version BETA et la base de données des signalements sera réinitilisée. Créer un compte actuellement vous donnera par défaut les permissions de gérant de serveur. Ces permissions seront plus tard données uniquement aux membres de confiance. C'est à dire que les joueurs inscrits pourront voir la liste des joueurs signalés, mais uniquement les membres de confiance pourront signaler d'autres joueurs. »</p>
    </div>
    <div class="hero-buttons">
        <?php if (!isset($_SESSION["user"]) && !isset($_SESSION["alreadyLogged"])): ?>
            <a class="hero-button" href="/users/register" >Inscription</a>
        <?php elseif (isset($_SESSION["alreadyLogged"]) && !isset($_SESSION["user"])): ?>
            <a class="hero-button" href="/users/login" >Connexion</a>
        <?php else: ?>
            <a class="hero-button" href="/posts">Liste</a>
        <?php endif; ?>
        <a class="hero-button" href="/posts/add">Dénoncer</a>
    </div>
</div>
<div class="index-main-container">
    <p style="margin-bottom: 100px; font-size: 1rem; font-style: italic; text-align: center; opacity: 0.7; mix-blend-mode: difference;">"La bienveillance est un langage universel compris de tous."</p>
    <div class="index-rich-text-container" data-tilt data-tilt-max="5" data-tilt-glare data-tilt-max-glare="0.4">
        <div class="index-rtc-left">
            <h3>À Propos</h3>
            <p>Snitch est un outils pour administrateur et modérateurs de serveurs minecraft permettant de signaler des joueurs aux autres membres du site.</p>
            <p>Notre base de données est accessible pour tous les membres du site et <strong>c'est gratuit</strong> !</p>
        </div>
        <div class="index-rtc-right">
            <img src="/assets/images/minecraft.png">
        </div>
    </div>
    <div class="index-double-container">
        <div class="index-rich-text-container" data-tilt data-tilt-max="5" data-tilt-glare data-tilt-max-glare="0.4">
            <div class="index-rtc-left">
                <h3>Pour vous ?</h3>
                <p>Nous cherchons à travailler avec les administrateurs de serveurs. C'est à dire les fondateurs, les modérateurs, etc.</p>
                <p>Snitch est un outil d'administration, il ne s'adresse donc pas aux joueurs directement.</p>
                <p>Pour avoir accès à la partie "Signaler" du site web vous devrez contacter l'admin du site.</p>
            </div>
        </div>
        <div class="index-rich-text-container" data-tilt data-tilt-max="5" data-tilt-glare data-tilt-max-glare="0.4" style="display: flex; align-items: center; justify-content: center">
            <div class="index-rtc-left animate-on-scroll">
                <h3 id="numberUsersDisplay" style="font-size: 6rem; text-align: center; margin-top: 10px" >0</h3>
                <h3 style="text-align: center">Signalements</h3>
                <p style="text-align: center">faits sur Snitch !</p>
            </div>
        </div>


    </div>
</div>

<script>
    function easeInOutCubic(t) {
        return t < 0.5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
    }

    function animateNumber(startValue, endValue, duration) {
        let startTime = null;

        function step(timestamp) {
            if (!startTime) startTime = timestamp;
            const progress = timestamp - startTime;
            const percentage = Math.min(progress / duration, 1);
            const easedProgress = easeInOutCubic(percentage);

            const currentValue = Math.floor(startValue + easedProgress * (endValue - startValue));

            $('#numberUsersDisplay').text(currentValue);

            if (percentage < 1) {
                requestAnimationFrame(step);
            }
        }

        requestAnimationFrame(step);
    }

    function startAnimationOnScroll() {
        const elements = document.querySelectorAll('.animate-on-scroll');
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.5 // Détecte lorsque l'élément est à moitié visible
        };

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const element = entry.target;
                    const endValue = <?= $data["numberReports"]->total ?>; // Récupérez la valeur depuis le contenu de l'élément
                    animateNumber(0, endValue, 2500); // 5000 ms (5 secondes) pour l'animation
                    observer.unobserve(element); // Une fois l'animation lancée, arrêtez d'observer cet élément
                }
            });
        }, observerOptions);

        elements.forEach(element => {
            observer.observe(element);
        });
    }

    // Lancez la fonction pour démarrer l'animation lorsqu'un élément est visible à l'écran
    $(document).ready(function() {
        startAnimationOnScroll();
    });
</script>