<?php
$title = "Profil";
$description = "Voir ou modifier le profil de l'utilisateur.";
?>

<div class="profile-main-container">
    <form class="profile-card" method="post" action="">
        <div class="profile-header">
            <p class="profile-header-username"><?php echo $_SESSION["user"]["username"] ?></p>
            <p class="profile-header-role"><?php if ($_SESSION["user"]["permissions"]===1){
                echo "Administrateur";
                } elseif ($_SESSION["user"]["permissions"]===2){
                echo "Gérant de serveur";
                } elseif ($_SESSION["user"]["permissions"]===3){
                echo "Membre";
                }?></p>
        </div>
        <img class="profile-head" src="https://mc-heads.net/avatar/<?php echo $_SESSION["user"]["username"]; ?>/100">
        <div class="profile-card-container">
            <div class="profile-left">
                <div class="log-reg-field">
                    <label for="username" class="label">Nom d'utilisateur</label>
                    <input class="log-reg-input" type="text" id="username" name="username" value="<?php echo $_SESSION["user"]["username"];?>">
                </div>
                <div class="log-reg-field">
                    <label for="email" class="label">Adresse email</label>
                    <input class="log-reg-input" type="email" id="email" name="email" value="<?php echo $_SESSION["user"]["email"];?>">
                </div>
            </div>
            <div class="profile-right">
                <div class="log-reg-field">
                    <label for="password" class="label">Modifier mot de passe</label>
                    <input class="log-reg-input" type="password" id="password" name="password">
                </div>
                <div class="log-reg-field">
                    <label for="password-confirm" class="label">Confirmer mot de passe</label>
                    <input class="log-reg-input" type="password" id="password-confirm" name="password-confirm">
                </div>
            </div>
        </div>
        <button class="log-reg-submit" type="submit">Sauvegarder</button>
        <button class="log-reg-submit" style="background-color: red; color: white;" onclick="confirmLogout()" type="button">Se déconnecter</button>
    </form>

</div>
