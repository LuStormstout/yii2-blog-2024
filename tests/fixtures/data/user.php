<?php

$faker = Faker\Factory::create();
$users = [];

for ($i = 0; $i < 82; $i++) {

    $isAdmin = 0;
    if($i <= 10){
        $isAdmin = 1;
    }

    $users[] = [
        'username' => strtolower($faker->firstName . '.' . $faker->lastName),
        'email' => $faker->unique()->email,
        'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('123456'),
        'auth_key' => Yii::$app->security->generateRandomString(),
        'is_admin' => $isAdmin,
        'created_at' => time(),
        'updated_at' => time(),
    ];
}

return $users;