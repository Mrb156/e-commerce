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
            'imageUrl' => 'https://th.bing.com/th/id/R.7f58c80bd74b3d1615c47dfb189292bb?rik=GWXR5jXEzifrsQ&pid=ImgRaw&r=0'
        ]);

        DB::table('products')->insert([
            'name' => 'Hosszúujjú póló',
            'description' => 'Ez egy férfi hosszúujjú póló',
            'sub_category_id' => 2,
            'price' => 5000,
            'imageUrl' => 'https://i5.walmartimages.com/asr/7e01438d-906a-4bee-b1e8-81c57e20a9ff_1.3fda29a2b15235e39d6d1cbd498626ba.jpeg'
        ]);
    }
}
