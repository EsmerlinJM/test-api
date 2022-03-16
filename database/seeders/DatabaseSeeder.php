<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        if(env('APP_ENV') == 'local' || env('APP_ENV') == 'development' || env('APP_ENV') == 'testing') {
            User::factory()->create();
            Phone::factory(11)->create();
            Address::factory(11)->create();
        }
    }
}
