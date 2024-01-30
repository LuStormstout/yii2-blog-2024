<?php

$faker = Faker\Factory::create();
$comments = [];

for ($i = 0; $i < 327; $i++) {
    $comments[] = [
        'post_id' => $faker->numberBetween(1, 64),
        'user_id' => $faker->numberBetween(1, 82),
        'content' => $faker->realText(rand(50, 200)),
        'created_at' => time(),
        'updated_at' => time(),
    ];
}

return $comments;