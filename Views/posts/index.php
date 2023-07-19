<?php
$title = "Liste";
$description = "Joueurs ayant été signalés sur Snitch.";
use App\Controllers\PostsController;
use App\Models\ReportedModel;
setlocale(LC_TIME, 'fr_FR.utf8');
?>

<section class="list-main-container">
    <div class="list-table">
        <div class="list-cell" id="list-cell-show" style="background: #e6e6e6; color: var(--dark-color)">
            <div class="list-cell-player">
                <p>Joueur</p>
            </div>
            <div>
                <p>Informations</p>
            </div>
            <div>
                <p></p>
            </div>
            <i>Date </i>
        </div>
        <?php foreach ($data as $post): ?>

            <?php $reportedModel = new ReportedModel();
            $reported = $reportedModel->findOneByUUID($post->reported_user_uuid);
        ?>
            <div class="list-cell">
                <div class="list-cell-player">
                    <img src="https://mc-heads.net/avatar/<?= strip_tags($post->reported_user_uuid) ?>/32">
                    <p><?= $reported->username ?></p>
                </div>
                <div>
                    <p><?= strip_tags(PostsController::shortContent($post->informations)) ?></p>
                    <div class="list-cell-reasons-container">
                        <p class="list-cell-reason" data-state="<?php if ($post->comportement) {echo "active";} ?>">Comportement</p>
                        <p class="list-cell-reason" data-state="<?php if ($post->vol) {echo "active";} ?>">Vol</p>
                        <p class="list-cell-reason" data-state="<?php if ($post->grief) {echo "active";} ?>">Grief</p>
                        <p class="list-cell-reason" data-state="<?php if ($post->xray) {echo "active";} ?>">XRay</p>
                        <p class="list-cell-reason" data-state="<?php if ($post->triche) {echo "active";} ?>">Triche</p>
                    </div>
                </div>
                <div class="list-cell-control">
                    <a href="/posts/more/<?= $post->id ?>" class="control-button">Voir plus</a>

                    <?php if(isset($_SESSION["user"]) && $post->user_id === $_SESSION["user"]["id"]): ?>
                        <a href="/posts/updatePost/<?= $post->id ?>" class="control-button">Modifier</a>
                        <a class="control-button" data-state="urgent" onclick="confirmDelete(<?php echo $post->id; ?>)">Supprimer</a>
                    <?php endif; ?>
                </div>
                <?php
                $date = date("d.m.y", strtotime($post->created_at));
                ?>
                <i><?= $date?> </i>
            </div>
        <?php endforeach;?>
    </div>

</section>

