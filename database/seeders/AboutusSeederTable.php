<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutusSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about_us')->insert(
            [
                'heading'=>'AyaMarket is an e-commerce of elegance ',
                'content'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione quibusdam saepe alias dignissimos consequatur ullam expedita voluptas commodi veritatis repellendus nostrum, tempore, ducimus architecto iure.',
                'image'=>'frontend/img/emart_bg.jpg'
            ]
        );
    }
}
