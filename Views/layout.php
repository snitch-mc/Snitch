<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Snitch<?php if (isset($title)) {echo " - ".$title;} else {echo "";}  ?></title>
        <meta name="description" content="<?php if (isset($description)) {echo $description;} else {echo "";}  ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="/stylesheets/global.css">
        <link rel="icon" type="image/x-icon" href="/assets/images/snitch.png">

        <!-- Socials -->
        <meta content="Snitch<?php if (isset($title)) {echo " - ".$title;} else {echo "";}  ?>" property="og:title">
        <meta content="<?php if (isset($description)) {echo $description;} else {echo "";}  ?>" property="og:description">
        <meta content="https://plsban.me/" property="og:url">
        <meta content="" property="og:image">
        <meta name="twitter:card" content="summary_large_image">
        <meta content="#5661F5" data-react-helmet="true" name="theme-color">
    </head>
    <!-- NAVBAR -->
    <div class="navbar">
        <div class="navbar-container">
            <div class="nav-logo">
                <a href="/">SNITCH</a>
            </div>
            <div id="burger-menu" data-state="close" onclick="burgerMenu()">
                <div class="burger-line"></div>
                <div class="burger-line"></div>
                <div class="burger-line"></div>
            </div>
            <div id="nav-items" data-state="close">
                <a href="/" class="txt-button augmented-button <?php if (str_contains($title, "Accueil")) {echo "is-active";}?>">Accueil</a>
                <a href="/posts/add" class="txt-button augmented-button <?php if (str_contains($title, "Signaler")) {echo "is-active";}?>">Signaler</a>
                <a href="/posts" class="txt-button augmented-button <?php if (str_contains($title, "Liste")) {echo "is-active";}?>">Liste</a>
                <?php if (isset($_SESSION["user"])): ?>

                    <?php $user = $_SESSION["user"]["username"]; ?>
                    <a href="/users/profile" class="txt-button augmented-button <?php if (str_contains($title, "Profil")) {echo "is-active";}?>"><img class="nav-user-head" src="https://mc-heads.net/avatar/<?php echo $user; ?>/100"><?php echo $user; ?></a>
                <?php endif; ?>
                <?php if (!isset($_SESSION["user"])): ?>
                    <a href="/users/login" class="txt-button augmented-button <?php if (str_contains($title, "Connexion")) {echo "is-active";}?>">Connexion</a>
                    <a href="/users/register" class="txt-button augmented-button <?php if (str_contains($title, "Inscription")) {echo "is-active";}?>">Inscription</a>
                <?php endif; ?>
                <img href="" onclick="toggleDarkMode()" id="dark-light-switch" class="augmented-button" src="/assets/images/sun.svg">
                <!--<a href="" onclick="toggleDarkMode()" class="txt-button">🌙</a>-->
            </div>
        </div>
    </div>
    <div class="error-dialog" id="error-dialog" data-state="<?php if (isset($_SESSION["errorMessage"])) {echo "visible";} else {echo "hidden";} ?>">
        <p><?php if (isset($_SESSION["errorMessage"])) { echo $_SESSION["errorMessage"];} ?></p>
        <button class="log-reg-submit" onclick="closeDialog()">Fermer</button>
    </div>

    <?= $content ?>


    <div class="footer">
        <p>Copyright ©️ <a href="https://thbo.ch/" target="_blank">WAXIE</a> 2023 - <a href="https://choosealicense.com/licenses/mit/" target="_blank">MIT License</a></p>
        <p style="margin-top: 10px;">Snitch is not affiliated with Mojang.</p>
    </div>
    <script src="/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
    <script>
        // Vérifie si le message d'erreur est défini dans la session
        var errorMessage = "<?php echo isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : ''; ?>";
        var successMessage = "<?php echo isset($_SESSION['successMessage']) ? $_SESSION['successMessage'] : ''; ?>";

        // Si le message d'erreur est présent, affiche l'alerte SweetAlert2
        if (errorMessage) {
            // Utiliser SweetAlert2 pour afficher l'alerte
            Swal.fire({
                icon: 'error',
                title: 'Erreur',
                text: errorMessage,
                confirmButtonText: 'Compris',
            }).then((result) => {
                // Si l'utilisateur clique sur le bouton "OK", supprime le message d'erreur de la session
                if (result.isConfirmed) {
                    <?php unset($_SESSION['errorMessage']); ?>
                }
            });
        }
        if (successMessage) {
            // Utiliser SweetAlert2 pour afficher l'alerte
            Swal.fire({
                icon: 'success',
                title: 'Succès',
                text: successMessage,
                confirmButtonText: 'Compris',
            }).then((result) => {
                // Si l'utilisateur clique sur le bouton "OK", supprime le message d'erreur de la session
                if (result.isConfirmed) {
                    <?php unset($_SESSION['successMessage']); ?>
                }
            });
        }
    </script>

    </body>
</html>