<?php

namespace Database\Seeders;

//use Laravel\Passport\Client;
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
            'redirect' => 'http://localhost',
            'personal_access_client' => '1',
            'password_client' => '0',
            'revoked' => '0',
        ]);

        PersonalAccessClient::create([
            'client_id' => $client->id,
        ]);
    }
}
