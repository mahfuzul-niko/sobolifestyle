<?php

namespace Database\Seeders;

use App\Models\FollowImage;
use Illuminate\Database\Seeder;

class FollowImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $keys = [
            'top_image',
            'left_image',
            'middle_image',
            'right_image'
        ];

        foreach ($keys as $key) {
            FollowImage::firstOrCreate(['key' => $key]);
        }
    }   
}
