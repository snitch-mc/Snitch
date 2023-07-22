<?php
$title = "Signaler";
$description = "Page pour signaler les joueurs.";
var_dump($_POST);
?>
<div class="report-main-container">
    <div class="report-panel-container">
        <div class="report-panel-left">
            <!-- <img class="report-left-player" src="https://crafatar.com/renders/body/45c25d2e-2519-49d3-8445-5c65cc6c3c05?overlay" alt=""> -->
            <img id="report-left-player" src="/assets/images/player.png" alt="">
        </div>
        <div class="report-panel-right">
            <form id="report-panel-form" method="post">
                <div class="form-div-input">
                    <label for="minecraft">Pseudo Minecraft</label>
                    <input type="text" name="minecraft" id="minecraft" placeholder="BadBoyXSwag" maxlength="16" required>
                </div>

                <div class="form-div-input">
                    <label for="minecraftuuid">Minecraft UUID</label>
                    <input type="text" name="minecraftuuid" id="minecraftuuid" placeholder="45c25d2e-2519-49d3-8445-5c65cc6c3c05" required readonly>
                    <input type="button" value="Find UUID" id="uuidbutton" onclick="uuidCalculator()">
                </div>
                <!--
                <div class="form-div-input">
                    <label for="discord">Discord ID (optionnel)</label>
                    <input type="text" name="discord" placeholder="540570040932761606">
                </div>
                -->


                <fieldset name="reason" id="reason" class="form-div-checkmark">

                    <label class="form-label-container" for="comportement">Comportement
                        <input type="checkbox" name="comportement" id="comportement">
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="vol">Vol
                        <input type="checkbox" name="vol" id="vol">
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="grief">Grief
                        <input type="checkbox" name="grief" id="grief">
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="xray">XRay
                        <input type="checkbox" name="xray" id="xray">
                        <span class="form-checkmark"></span>
                    </label>

                    <label class="form-label-container" for="triche">Triche
                        <input type="checkbox" name="triche" id="triche">
                        <span class="form-checkmark"></span>
                    </label>

                </fieldset>
                <div class="form-div-input">
                    <label for="description">Informations supplémentaires</label>
                    <textarea name="description" id="" cols="30" rows="10"></textarea>
                </div>

                <input type="submit" value="Soumettre">

            </form>
        </div>
    </div>
</div>