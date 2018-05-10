<?php

$factory->define(App\TourProgram::class, function (Faker\Generator $faker) {
    return [
        "month" => collect(["Select Month","January","February","March","April","May","June","July","August","September","October","November","December",])->random(),
        "select_date" => $faker->date("Y-m-d", $max = 'now'),
        "medical_representative_name" => $faker->name,
        "area" => $faker->name,
        "modification" => $faker->name,
        "remarks" => $faker->name,
        "work_with_manager" => $faker->name,
    ];
});
