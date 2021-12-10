<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Home Deco',
                'slug' => 'home-deco',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => 'b4d972-9.jpg',
            ],
            [
                'name' => 'Modern Rocking Chair',
                'slug' => 'modern-rocking-chai',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => 'cdcbd4-8.jpg',
            ],
            [
                'name' => 'Metallic Chair',
                'slug' => 'metallic-chair',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => '06a41f-7.jpg',
            ],
            [
                'name' => 'Small Table',
                'slug' => 'small-table',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => '77c9a9-6.jpg',
            ],
            [
                'name' => 'Plant Pot',
                'slug' => 'plant-pot',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => 'deab7a-5.jpg',
            ],
            [
                'name' => 'Night Stand',
                'slug' => 'night-stand',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => 'b13994-4.jpg'
            ],
            [
                'name' => 'Minimalistic Plant Pot',
                'slug' => 'minimalistic-plant-po',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => '6c38c6-2.jpg',
            ],
            [
                'name' => 'Modern Chair',
                'slug' => 'modern-chair',
                'status' => '1',
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
                'image' => '0266f7-pro-big-1.jpg',
            ],
        ];
        foreach ($data as $value) {
            DB::table('category')->insert($value);
        }
    }
}
