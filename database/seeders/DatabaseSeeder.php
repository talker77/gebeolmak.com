<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
//        $this->call(CategorySeeder::class);
        $this->call(KategorilerTableSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(AyarlarTableSeeder::class);
        $this->call(ForumSeeder::class);
        $this->call(ForumCommentSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(ContentSeeder::class);

//        $this->call(CityTownTableSeeder::class);
//        $this->call(CargoSeeder::class);
//        $this->call(AddressSeeder::class);
    }
}
