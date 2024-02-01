<?php

namespace app\models;

use yii\base\Model;

class LoginForm extends Model
{
    public ?string $username = null;
    public ?string $password = null;

    public function login(): bool
    {
        return true;
    }
}