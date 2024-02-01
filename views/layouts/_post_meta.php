<?php
/* @var $post app\models\Post */

use yii\helpers\Url;

?>

<p class="blog-post-meta text-secondary">
    Published on <a href="<?= Url::to(['view', 'id' => $post->id]) ?>"
                    class="font-weight-bold"><?= $post->created_at ?></a>
    By <a href="<?= Url::to(['index', 'author' => $post->user->id]) ?>"
          class="font-weight-bold"><?= $post->user->username ?></a>
</p>