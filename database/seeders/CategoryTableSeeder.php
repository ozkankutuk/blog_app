<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $files = [
            public_path( '/images/1.jpg' ),
            public_path( '/images/2.jpg' ),
            public_path( '/images/3.jpg' ),
            public_path( '/images/4.jpg' ),
        ];

        for($i = 0; $i < 10 ; $i++){
            $file_path = $files[ array_rand( $files, 1 ) ];

            $faker = \Faker\Factory::create();
            $array = [
                'name'=>$faker->sentence
            ];

            $category = Category::create($array);
            $category->addMedia( $file_path )
                ->preservingOriginal()
                ->toMediaCollection( 'category_image' );
        }


    }
}
