<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'level' => 'user',
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween($min = 1, $max = 10),        
        'comment' => $faker->text($maxNbChars = 200),      
        'ip'      => $faker->ipv4,
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
    ];
});


$factory->define(App\Student::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,        
        'surname' => $faker->lastName,      
    ];
});   
   