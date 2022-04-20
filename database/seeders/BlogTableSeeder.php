<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for($i = 0; $i < 100; $i ++){
            $blog = [
                'title'       => $faker->sentence,
                'content'     => $faker->paragraphs( 10, true ),
                'category_id' => Category::inRandomOrder()->first()->id,
                'created_at' => $faker->dateTimeBetween( 'now -1 years', 'now' )->format( 'Y-m-d H:i:s' ),
            ];



            Blog::create($blog);
        }


    }
}
