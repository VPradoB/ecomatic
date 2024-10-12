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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Stat::class,function (Faker\Generator $faker) {

    return [
        'machine_id' => $faker->numberBetween(1,10),
        'product_id' => $faker->numberBetween(1,10),
        'date' => '2010-11-01',
        'hour' => 2,
        'event_types_id' => 1,
        'product_count' => $faker->numberBetween(10,50),
        'created_at'    => $faker->dateTimeBetween('-1 years'),
        'updated_at'    =>$faker->dateTimeBetween('-1 years')
    ];
});

$factory->define(App\Machine::class,function (Faker\Generator $faker) {

    return [
        'mac'=> $faker->unique()->postcode,
        'name' => $faker->unique()->userName,
        'ubication' => $faker->city
    ];
});

$factory->define(App\Product::class,function (Faker\Generator $faker) {

    return [
        'name'=> $faker->text(10),
        'price' => $faker->numberBetween(5000,10000)
    ];
});

$factory->define(App\Sale::class,function (Faker\Generator $faker) {
        $price = $faker->numberBetween(5000,10000);
        $quantity =$faker->numberBetween(1,10);
    return [
        'product_id'        => $faker->numberBetween(1,10),
        'machine_id'        => $faker->numberBetween(1,10) ,
        'price'             => $price,
        'quantity'          => $quantity,
        'total_amount'      => $price * $quantity,
        'created_at'        => $faker->dateTimeBetween('-1 years'),
        'updated_at'        =>$faker->dateTimeBetween('-1 years')
    ];
});
