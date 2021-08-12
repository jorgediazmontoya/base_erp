<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    use HasFactory;

    protected $table = 'mails';

    protected $fillable = ['transport', 'host', 'port', 'encryption', 'username', 'password'];

    /**
     * tenant
     *
     * @return void
     */
    public function tenant ()
    {
        return $this->belongsTo(CustomTenant::class, 'tenant_id');
    }
}
