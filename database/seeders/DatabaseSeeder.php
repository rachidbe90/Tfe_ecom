<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AboutusSeederTable::class);
        $this->call(ProductsTableSeeder::class);
        \App\Models\Category::factory(5)->create();
        \App\Models\User::factory(10)->create();
        \App\Models\Product::factory(80)->create();

    }
}
