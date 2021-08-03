<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Passport\Client as PassportClient;

class Client extends Model //PassportClient
{
    protected $table = 'oauth_clients';
    //protected $connection = 'tenant';
}
