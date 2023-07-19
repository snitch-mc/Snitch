<?php
$title = "Connexion";
$description = "Page de connexion.";
?>
<div class="log-reg-main-container">
    <form style="display: flex; justify-content: center" method="post" action="">
        <div class="log-reg-header-content-container">
            <header class="log-reg-header">
                <p class="">
                    Connexion
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <div class="log-reg-field">
                        <label class="label" for="email">Adresse email</label>
                        <input class="log-reg-input" id="email" type="email" name="email" placeholder="Votre adresse email">
                    </div>
                    <div class="log-reg-field">
                        <label class="label" for="password">Mot de passe</label>
                        <input class="log-reg-input" id="password" type="password" name="password" placeholder="Votre mot de passe">
                    </div>
                </div>
            </div>
            <button class="log-reg-submit" type="submit"><strong>Se connecter</strong></button>
        </div>
    </form>
</div>