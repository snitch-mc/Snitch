<?php
$title = "Inscription";
$description = "Page d'inscription.";
?>
<div class="log-reg-main-container">
    <form style="display: flex; justify-content: center" method="post" action="">
        <div class="log-reg-header-content-container">
            <header class="log-reg-header">
                <p class="">
                    Inscription
                </p>
            </header>
            <div class="card-content">
                <div class="content">
                    <div class="log-reg-field">
                        <label class="label" for="username">Nom d'utilisateur</label>
                        <input class="log-reg-input" type="text" id="username" name="username" placeholder="Votre nom d'utilisateur">
                    </div>
                    <div class="log-reg-field">
                        <label class="label" for="email">Adresse email</label>
                        <input class="log-reg-input" id="email" type="email" name="email" placeholder="Votre adresse email">
                    </div>
                    <div class="log-reg-field">
                        <label class="label" for="password">Mot de passe</label>
                        <input class="log-reg-input" id="password" type="password" name="password" placeholder="Votre mot de passe">
                    </div>
                    <div class="log-reg-field">
                        <label class="label" for="confirmpassword">Confirmer le mot de passe</label>
                        <input class="log-reg-input" id="confirmpassword" type="password" name="confirmpassword" placeholder="Votre mot de passe">
                    </div>
                </div>
            </div>
            <button class="log-reg-submit" type="submit"><strong>S'inscrire</strong></button>
            <a href="/users/login" style="font-size: 0.7rem; margin-top: 50px">Déjà inscrit ? Clique ici.</a>
        </div>
    </form>
</div>

