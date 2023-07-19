
<?php
$title = "Édition d'un signalement";
$description = "Éditer un signalement déjà envoyé.";
?>
<div class="report-main-container">
    <div class="report-panel-container">
        <div class="report-panel-left">
            <img class="report-left-player" src="https://crafatar.com/renders/body/<?=$data[0]->reported_user_uuid?>?overlay" alt="">
        </div>
        <div class="report-panel-right">
            <form id="report-panel-form" method="post">
                <div class="form-div-input">
                    <label for="minecraft">Pseudo Minecraft</label>
                    <input type="text" name="minecraft" id="minecraft" placeholder="BadBoyXSwag" value="<?= $data[1]->username?>" maxlength="16" required readonly title="Vous ne pouvez pas modifier cette information.">
                </div>

                <div class="form-div-input">
                    <label for="minecraftuuid">Minecraft UUID</label>
                    <input type="text" name="minecraftuuid" id="minecraftuuid" placeholder="45c25d2e-2519-49d3-8445-5c65cc6c3c05" value="<?=$data[0]->reported_user_uuid?>" required readonly title="Vous ne pouvez pas modifier cette information.">
                    <!--<input type="button" value="Find UUID" id="uuidbutton" onclick="uuidCalculator()"> -->
                </div>
                <!--
                <div class="form-div-input">
                    <label for="discord">Discord ID (optionnel)</label>
                    <input type="text" name="discord" placeholder="540570040932761606">
                </div>
                -->


                <fieldset name="reason" id="reason" class="form-div-checkmark">

                    <label class="form-label-container" for="comportement">Comportement
                        <input type="checkbox" name="comportement" id="comportement" <?php if ($data[0]->comportement) {echo "checked";}?>>
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="vol">Vol
                        <input type="checkbox" name="vol" id="vol" <?php if ($data[0]->vol) {echo "checked";}?>>
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="grief">Grief
                        <input type="checkbox" name="grief" id="grief" <?php if ($data[0]->grief) {echo "checked";}?>>
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="xray">XRay
                        <input type="checkbox" name="xray" id="xray" <?php if ($data[0]->xray) {echo "checked";}?>>
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="triche">Triche
                        <input type="checkbox" name="triche" id="triche" <?php if ($data[0]->triche) {echo "checked";}?>>
                        <span class="form-checkmark"></span>
                    </label>

                </fieldset>
                <div class="form-div-input">
                    <label for="description">Informations supplémentaires</label>
                    <textarea name="description" id="" cols="30" rows="10"><?=$data[0]->informations?></textarea>
                </div>

                <input type="submit" value="Mettre à jour">
                <input type="button" onclick="history.back()" value="Annuler" style="margin-top: 20px; background: #ff0000; color: var(--light-color)">

            </form>
        </div>
    </div>
</div>