<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PassportSeeder;
use Spatie\Multitenancy\Models\Tenant;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //if (Tenant::checkCurrent()) {
            $this->call(PassportSeeder::class);
        //}
    }
}
