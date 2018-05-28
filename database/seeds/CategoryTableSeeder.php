<?php

use Illuminate\Database\Seeder;
use App\Models\Category\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name'  =>  'Gulay'
        ]);

        Category::create([
            'name'  =>  'Pulutan'
        ]);

        Category::create([
            'name'  =>  'Appetizer'
        ]);

        Category::create([
            'name'  =>  'Panghimagas'
        ]);

        Category::create([
            'name'  =>  'Others'
        ]);

        Category::create([
            'name'  =>  'Inumin'
        ]);

        Category::create([
            'name'  =>  'Sabaw'
        ]);

        Category::create([
            'name'  =>  'Inihaw'
        ]);

        Category::create([
            'name'  =>  'Prito'
        ]);

        Category::create([
            'name'  =>  'Pinoy Specialties'
        ]);

        Category::create([
            'name'  =>  'Merienda Classic'
        ]);

        Category::create([
            'name'  =>  'Almusal'
        ]);
    }
}
