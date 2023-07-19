<?php
?>
<div class="list-main-container">
    <div class="list-more-card">
        <div class="list-more-card-left">
            <p class="list-mcr-playertag"><?= $reportedUser->username ?></p>
            <img src="https://crafatar.com/renders/body/<?= $post->reported_user_uuid ?>?overlay">
        </div>
        <div class="list-more-card-right">
            <button class="control-button" onclick="history.back()" style="margin-bottom: 10px">< Retour</button>
            <button class="control-button" onclick="openNameMC('<?= $post->reported_user_uuid ?>')" style="margin-bottom: 10px">Voir sur NameMC</button>
            <p class="list-mcr-reported-by">Dénoncé par @<?= $reportedBy->username?></p>
            <p class="list-mcr-reported-user"><?= $reportedUser->username?></p>
            <p class?="list-mcr-description"><?= $post->informations?></p>
            <div class="list-cell-reasons-container">
                <p class="list-cell-reason" data-state="<?php if ($post->comportement) {echo "active";} ?>">Comportement</p>
                <p class="list-cell-reason" data-state="<?php if ($post->vol) {echo "active";} ?>">Vol</p>
                <p class="list-cell-reason" data-state="<?php if ($post->grief) {echo "active";} ?>">Grief</p>
                <p class="list-cell-reason" data-state="<?php if ($post->xray) {echo "active";} ?>">XRay</p>
                <p class="list-cell-reason" data-state="<?php if ($post->triche) {echo "active";} ?>">Triche</p>
            </div>

            <div class="list-mcr-control-container">
                <?php if(isset($_SESSION["user"]) && $post->user_id === $_SESSION["user"]["id"]): ?>
                <a href="/posts/updatePost/<?= $post->id ?>" class="control-button">Modifier</a>
                <a class="control-button" data-state="urgent" onclick="confirmDelete(<?php echo $post->id; ?>)">Supprimer</a>
                <?php endif; ?>
            </div>
            <?php
            $date = date("d F Y \à H\hi", strtotime($post->created_at));
            ?>
            <p class="list-mcr-reported-by" style="margin-top: 20px">Le <?= $date?> </p>

        </div>
    </div>
</div>

