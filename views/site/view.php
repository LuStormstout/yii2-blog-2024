<?php

/* @var $post app\models\Post */
/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'Post Detail';
?>

<div class="blog-post bg-white p-5 rounded shadow mb-4">
    <h3 class="blog-post-title"><?= $post->title ?></h3>

    <!-- Post Meta Template -->
    <?= $this->render('../layouts/_post_meta',['post' => $post]) ?>

    <hr>

    <?= $post->content ?>

    <?php if (!Yii::$app->user->isGuest && (Yii::$app->user->identity->is_admin || Yii::$app->user->identity->id == $post->user_id)): ?>
        <form class="mt-4" action="<?= Url::to(['post/delete', 'id' => $post->id]) ?>" method="post">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                   value="<?= Yii::$app->request->csrfToken ?>">
            <button type="submit"
                    onclick="return confirm('The deletion action is irreversible. Do you want to proceed with the deletion?')"
                    class="btn btn-danger btn-sm">Delete
            </button>
            <a href="<?= Url::to(['post/edit', 'id' => $post->id]) ?>"
               class="btn btn-outline-secondary btn-sm">Edit</a>
        </form>
    <?php endif; ?>
</div>
