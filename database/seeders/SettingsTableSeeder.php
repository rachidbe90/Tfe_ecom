<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 *
 */
class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //home banner
        DB::table('banners')->insert([
            [
                'title'=>'Special Offer',
                'description'=>'Only € 78',
                'photo'=>'frontend/img/bg-img/8.jpg',
                'status'=>'active',
                'condition'=>'banner',
            ],
            [
                'title'=>'Sustainable Clock',
                'description'=>'Only € 31 ',
                'photo'=>'frontend/img/bg-img/7.jpg',
                'status'=>'active',
                'condition'=>'banner',
            ],
            [
                'title'=>'Hot Shoes',
                'description'=>'Now € 19',
                'photo'=>'frontend/img/bg-img/6.jpg',
                'status'=>'active',
                'condition'=>'banner',
            ],
            [
                'title'=>'ALL KID’S ITEMS',
                'description'=>'30% OFF',
                'photo'=>'frontend/img/bg-img/fea_offer.jpg',
                'status'=>'active',
                'condition'=>'promo',
            ],
        ]);

        //categories
        DB::table('categories')->insert([
            //Parent Categories
            [
                'title'=>'Craft Collection',
                'slug'=>'craft-collection',
                'photo'=>'frontend/img/category/cata-1.jpg',
                'is_parent'=>1,
                'parent_id'=>null,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
            [
                'title'=>'Women Collection',
                'slug'=>'women-collection',
                'photo'=>'frontend/img/category/cata-2.jpg',
                'is_parent'=>1,
                'parent_id'=>null,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],

            [
                'title'=>'Kids Collection',
                'slug'=>'kids-collection',
                'photo'=>'frontend/img/category/cata-3.jpg',
                'is_parent'=>1,
                'parent_id'=>null,
                'status'=>'active',
                'created_at'=>Carbon::now(),
                'updated_at'=>Carbon::now(),
            ],
        ]);


        //settings

        DB::table('settings')->insert([
            'title'=>'AyaMarket online shopping',
            'meta_description'=>'AyaMarket online shopping.',
            'meta_keywords'=>'AyaMarket, Online Shopping, E-commerce website',
            'logo'=>'/storage/photos/shares/AYA.png',
            'favicon'=>'/storage/photos/shares/AYA.png',
            'address'=>'Charleroi Belgique',
            'email'=>'info@ayamarket.com',
            'phone'=>'+32490191923',
            'fax'=>'+3271593541',
            'footer'=>'Rachid AHGGOUNE @ 2022 All right reserved.',
            'facebook_url'=>'',
            'twitter_url'=>'',
            'linkedin_url'=>'',
            'pinterest_url'=>'',
        ]);
    }
}
