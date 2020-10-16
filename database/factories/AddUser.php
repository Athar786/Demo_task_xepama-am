<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\adduser;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(adduser::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'number'=>$faker->number,
        'gender'=>$faker->gender,
        'state'=>$faker->state,
        'city'=>$faker->city,
        'address'=>$faker->address,
    ];
});


adduser::create([
    'name' => 'abc',
    'number'=>9558239911,
    'gender' => 'abc@gmail.com',
    'state' => '1',
    'city'=> '1',
    'address'=>'asd',
]);

// factory(adduser::class)->create(); 
// factory(adduser::class)->make();