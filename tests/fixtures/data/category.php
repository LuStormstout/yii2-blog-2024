<?php

$faker = Faker\Factory::create();
$categories = [];

for ($i = 0; $i < 9; $i++) {
    $categories[] = [
        'name' => ucfirst($faker->words(rand(1, 3), true)),
        'description' => $faker->sentence(rand(6, 10)),
        'created_at' => time(),
        'updated_at' => time(),
    ];
}

return $categories;