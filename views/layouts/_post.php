<?php

/* @var $post app\models\Post */

use yii\helpers\Url;
?>

<div class="blog-post bg-white p-5 rounded shadow mb-4">
    <h3 class="blog-post-title">
        <a class="text-dark text-decoration-none" href="<?= Url::to(['view', 'id' => $post->id]); ?>"><?= $post->title; ?></a>
    </h3>

    <!-- Post Meta Template -->
    <?= $this->render('../layouts/_post_meta', ['post' => $post]); ?>

    <hr>

    <p><?= $post->content; ?></p>
</div>