<?php
$title = "Paramètres";
$description = "Paramètres du site web";
?>

<div class="settings-main-container">
    <div class="settings-card-container">
        <p class="settings-title">Paramètres du site</p>
        <div>
            <form method="post">
                <div class="settings-input-container toggle-container">
                    <p>Mode maintenance</p>
                    <div class="toggle">
                        <input type="checkbox" id="maintenance-mode" name="maintenance-mode" <?php if ($data[0]->value){echo "checked";} ?>>
                        <label for="maintenance-mode"></label>
                    </div>
                </div>
                <div class="settings-input-container">
                    <label for="maintenance-title">Titre de la page de maintenance</label>
                    <input type="text" name="maintenance-title" id="maintenance-title" class="log-reg-input" value="<?= $data[1]->value?>">
                </div>
                <div class="settings-input-container">
                    <label for="maintenance-title">Description de la page de maintenance</label>
                    <input type="text" name="maintenance-description" id="maintenance-description" class="log-reg-input" value="<?= $data[2]->value?>">
                </div>
                <button class="log-reg-submit" type="submit">Sauvegarder</button>
                <button class="log-reg-submit" style="background-color: red; color: white;" onclick="location.reload()" type="button">Annuler</button>
            </form>
        </div>
    </div>
</div>
