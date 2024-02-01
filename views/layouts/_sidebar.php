<?php
/* @var $categories Category[] */

/* @var $admins User[] */

use app\models\Category;
use app\models\User;
use yii\helpers\Url;

?>

<div class="col-md-3 blog-sidebar">
    <div class="p-4 mb-3 bg-white rounded shadow-sm">
        <h1><a href="/" class="link-dark text-decoration-none">LuStormstout</a></h1>
        <p class="mb-0">Discard worldly frivolity, pursue technical excellence.</p>
    </div>

    <div class="p-4 bg-white rounded shadow-sm mb-3">
        <h5>Categories</h5>
        <ol class="list-unstyled mb-0">
            <?php if ($categories): ?>
                <?php foreach ($categories as $category) : ?>
                    <li><a href="{{ $category.Link }}"><?= $category->name ?></a></li>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php if (!Yii::$app->user->isGuest && Yii::$app->user->identity->is_admin): ?>
                <li><a href="<?= Url::to(['category/create']) ?>">Create Category</a></li>
            <?php endif; ?>
        </ol>
    </div>

    <?php if ($admins): ?>
        <div class="p-4 bg-white rounded shadow-sm mb-3">
            <h5>Author</h5>
            <ol class="list-unstyled mb-0">
                <?php foreach ($admins as $admin): ?>
                    <li><a href="{{ $user.Link }}"><?= $admin->username ?></a></li>
                <?php endforeach; ?>
            </ol>
        </div>
    <?php endif; ?>

    <div class="p-4 bg-white rounded shadow-sm mb-3">
        <h5>Link</h5>
        <ol class="list-unstyled">
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <?php if (!Yii::$app->user->isGuest): ?>

                <?php if (Yii::$app->user->identity->is_admin): ?>
                    <li><a href="<?= Url::to(['article/create']) ?>">Publish</a></li>
                <?php endif; ?>
            
                <li class="mt-3">
                    <form action="<?= Url::to(['auth/logout']) ?>" method="post"
                          onsubmit="return confirm('Are you sure you want to log out?')">
                        <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>"
                               value="<?= Yii::$app->request->csrfToken ?>"/>
                        <button class="btn btn-block btn-outline-danger btn-sm" type="submit" name="button">Logout
                        </button>
                    </form>
                </li>
            <?php else: ?>
                <li><a href="<?= Url::to(['auth/register']) ?>">Register</a></li>
                <li><a href="<?= Url::to(['auth/login']) ?>">Login</a></li>
            <?php endif; ?>
        </ol>
    </div>
</div>