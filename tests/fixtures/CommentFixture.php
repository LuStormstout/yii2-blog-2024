<?php

namespace tests\fixtures;

use yii\test\ActiveFixture;

class CommentFixture extends ActiveFixture
{
    public $modelClass = 'app\models\Comment';
    public $depends = ['tests\fixtures\PostFixture', 'tests\fixtures\UserFixture'];
    public $dataFile = '@tests/fixtures/data/comment.php';
}