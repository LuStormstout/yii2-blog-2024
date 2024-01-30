<?php

$faker = Faker\Factory::create();
$posts = [];

for ($i = 0; $i < 64; $i++) {
    $posts[] = [
        'user_id' => $faker->numberBetween(1, 10),
        'category_id' => $faker->numberBetween(1, 9),
        'title' => rtrim($faker->sentence(rand(3, 6)), '.'),
        'content' => implode("\n\n", $faker->paragraphs(rand(3, 5))),
        'status' => $faker->randomElement([0, 1]), // Assuming 0 is draft and 1 is published
        'created_at' => time(),
        'updated_at' => time(),
    ];
}

return $posts;