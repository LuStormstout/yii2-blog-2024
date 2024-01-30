<?php

namespace app\controllers;

use yii\web\Controller;

class CategoryController extends Controller
{
    public function actionIndex(): string
    {
        return $this->render('index');
    }

}
