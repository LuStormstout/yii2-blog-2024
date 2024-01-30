<?php

namespace tests\fixtures;

use yii\test\ActiveFixture;

class PostFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Post';
    public $depends = ['tests\fixtures\UserFixture', 'tests\fixtures\CategoryFixture'];
    public $dataFile = '@tests/fixtures/data/post.php';
}