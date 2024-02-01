<?php

/** @var yii\web\View $this */

/** @var string $content */
/** @var $categories Category[] */

/** @var $admins User[] */

use app\assets\AppAsset;
use app\models\Category;
use app\models\User;
use yii\bootstrap5\Html;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

$categories = Category::find()->all();
$admins = User::find()->where(['is_admin' => true])->all();

?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="UTF-8">
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>

    <body>
    <?php $this->beginBody() ?>

    <div class="container-sm">
        <div class="row mt-5">

            <?= $this->render('_sidebar', [
                'categories' => $categories,
                'admins' => $admins,
            ]) ?>

            <div class="col-md-9 main">
                <?= $content ?>
            </div>

        </div>
    </div>

    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>