<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Utilities\Constant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Constant::CATEGORY;

        foreach ($category as $key => $value) {
            
            
            DB::table('categories')->insert([
                'id' => $value['id'],
                'label' => $value['label'],
            ]); 
            // Category::create([
            //     'id' => $value['id'],
            //     'label' => $value['label'],

            // ]);
        }
    }
}
