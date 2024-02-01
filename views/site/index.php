<?php

/* @var $pagination yii\data\Pagination */

/* @var $posts app\models\Post[] */

use yii\helpers\Url;

$this->title = 'Lu Stormstout';
?>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <?= $this->render('../layouts/_post', ['post' => $post]) ?>
    <?php endforeach; ?>
<?php else: ?>
    <div class="blog-post bg-white p-5 rounded text-muted mb-4">
        <h3 class="blog-post-title">No posts found</h3>
    </div>
<?php endif; ?>

<nav class="blog-pagination mb-5">
    <?php
    // 获取当前请求的筛选参数
    // Get the filter parameters of the current request
    $queryParams = Yii::$app->request->queryParams;

    // 上一页链接的参数
    // Previous page link parameters
    $prevPageParams = array_merge($queryParams, ['site/index', 'page' => $pagination->getPage()]);
    // 下一页链接的参数
    // Next page link parameters
    $nextPageParams = array_merge($queryParams, ['site/index', 'page' => $pagination->getPage() + 2]);

    if ($pagination->getPage() > 0): ?>
        <a class="btn btn-outline-primary" href="<?= Url::to($prevPageParams) ?>">Previous</a>
    <?php else: ?>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Previous</a>
    <?php endif; ?>

    <?php if ($pagination->getPage() < $pagination->getPageCount() - 1): ?>
        <a class="btn btn-outline-primary" href="<?= Url::to($nextPageParams) ?>">Next</a>
    <?php else: ?>
        <a class="btn btn-outline-secondary disabled" href="#" tabindex="-1" aria-disabled="true">Next</a>
    <?php endif; ?>
</nav>


