<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Multitenancy\Models\Concerns\UsesTenantConnection;

class File extends Model
{
    use HasFactory, UsesTenantConnection;

    protected $table = 'files';

    protected $fillable = ['name', 'url'];
}
