<?php
$title = "Accueil";
$description = "Signalez, protégez, jouez. La plateforme essentielle pour les administrateurs de serveurs Minecraft. Pour une communauté francophone Minecraft plus sûre et agréable.";
?>
<div class="hero">
    <video autoplay loop muted plays-inline class="hero-video">
        <source src="/assets/videos/bg.webm" type="video/webm">
    </video>
    <!-- <a href="https://youtu.be/FqnAV6tkwzA" target=”_blank” id="chill-button"> CHILL</a> -->
    <div class="hero-text">
        <p class="hero-title">SNITCH</p>
        <p class="hero-description">Signalez, protégez, jouez. La plateforme essentielle pour les administrateurs de serveurs.</p>
        <p class="hero-description">Vers une communauté francophone Minecraft plus sûre et agréable.</p>
    </div>
    <div class="hero-buttons">
        <?php if (!isset($_SESSION["user"]) && !isset($_SESSION["alreadyLogged"])): ?>
            <a class="hero-button" href="/users/register" >Inscription</a>
        <?php elseif (isset($_SESSION["alreadyLogged"]) && !isset($_SESSION["user"])): ?>
            <a class="hero-button" href="/users/login" >Connexion</a>
        <?php else: ?>
            <a class="hero-button" href="/posts" >Liste</a>
        <?php endif; ?>
        <a class="hero-button" href="/posts/add">Dénoncer</a>
    </div>
</div>