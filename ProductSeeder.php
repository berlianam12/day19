<?php

namespace Database\Seeders;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        for($i = 1; $i <= 50; $i++){
           \DB::table('products')->insert([
                'product_name' => $faker->sentence(2, true),
                'product_code' => $faker->word(),
                'price' => $faker->randomFloat(2, 10, 1000),
                'created_at' => $faker->dateTime('now', null),
                'updated_at' => $faker->dateTime('now', null),
            ]);
        }
    }
}
