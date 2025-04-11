<?php

/** @var yii\web\View $this */
?>
<h1>Film list</h1>

<div class="container">
    <div class="row row-cols-3">
        <?php if ($filmsSession) : ?>
            <?php foreach ($filmsSession as $filmSession) : ?>
                <div class="col">
                    <div style="display:flex; flex-direction:column; max-width: 250px;">
                        <img src="<?= $filmSession->film->getImagePath() ?>">
                        <span><?= $filmSession->film->title ?></span>
                        <span><?= date('Y-m-d H:i', $filmSession->start_time) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>