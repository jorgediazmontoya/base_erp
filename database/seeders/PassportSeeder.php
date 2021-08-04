<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;
use Laravel\Passport\PersonalAccessClient;

class PassportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = Client::create([
            'name' => 'Personal Access Client',
            'secret' => config('passport.personal_access_client.secret'),
            'provider' => 'users',
            'redirect' => 'http://localhost',
            'personal_access_client' => '0',
            'password_client' => '1',
            'revoked' => '0',
        ]);

        PersonalAccessClient::create([
            'client_id' => $client->id,
        ]);
    }
}
