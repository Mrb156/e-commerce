<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            'name' => 'Rövidujjú',
            'description' => 'Ez egy női rövidujjú póló',
            'sub_category_id' => 1,
            'price' => 2000,
        ]);

        DB::table('products')->insert([
            'name' => 'Hosszúujjú póló',
            'description' => 'Ez egy férfi hosszúujjú póló',
            'sub_category_id' => 2,
            'price' => 5000,
        ]);
    }
}
