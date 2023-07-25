<?php
$title = "Joueur signalés";
$description = "Retrouvez la liste des joueurs signalés.";
use App\Models\PostsModel;
?>


<section class="reported-main-container">
    <div class="reported-card-container">
        <?php foreach ($data as $reported_user): ?>

            <?php
            $postsModel = new PostsModel();
            $numberTimeReported = $postsModel->findNumberTimeReported($reported_user->uuid);
            ?>
            <div class="reported-card">
                <div class="reported-card-user">
                    <img src="https://mc-heads.net/avatar/<?= strip_tags($reported_user->uuid) ?>/32">
                    <p><?= $reported_user->username ?></p>
                </div>
                <p style="margin-bottom: 10px">Dénoncé <?= $numberTimeReported->total ?>x</p>
                <a href="/reported/user/<?= $reported_user->id ?>" class="control-button">Voir le joueur</a>

            </div>
        <?php endforeach;?>
    </div>
</section>
