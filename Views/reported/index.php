<?php
$title = "Joueur signalés";
$description = "Retrouvez la liste des joueurs signalés.";
use App\Models\PostsModel;
?>


<section class="reported-main-container">
    <form method="post" style="display: flex; flex-direction: column; gap: 10px; margin: 50px; justify-content: center; align-items: center">
        <label for="recherche">Rechercher un joueur</label>
        <input name="recherche" id="recherche" value="<?php if (isset($_POST["recherche"])){echo $_POST["recherche"];} ?>">
        <button>Rechercher</button>
    </form>
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
