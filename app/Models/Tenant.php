<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Multitenancy\Models\Tenant as BaseTenant;
use Illuminate\Support\Str;

/**
 * Create a custom Tenant
 */
class Tenant extends BaseTenant
{
    use HasFactory;

    protected $guarded = [];

    /**
     * boot
     *
     * Creating a database and migrations
     * @return void
     */
    public static function boot () {
        static::creating (function (Tenant $tenant) {
            return $tenant->createDatabase($tenant);
        });

        static::created (function (Tenant $tenant) {
            return $tenant->runMigrationsSeeders($tenant);
        });
    }

    /**
     * createDatabase
     *
     * Create a database for tenant
     * @param  mixed $tenant
     * @return void
     */
    public function createDatabase($tenant) {
        $database_name = parse_url(config('app.url'), PHP_URL_HOST).'_'.Str::random(4);
        $database = Str::of($database_name)->replace('.', '_')->lower()->__toString();

        $query = "SELECT name FROM sys.databases WHERE name = ?";
        $db = DB::select($query, [$database]);

        if (empty($db)) {
            DB::connection('tenant')->statement("CREATE DATABASE {$database};");
            $tenant->database = $database;
        }

        return $database;
    }

    /**
     * runMigrationsSeeders
     *
     * Running migrations
     * @param  mixed $tenant
     * @return void
     */
    public function runMigrationsSeeders($tenant) {
        $tenant->refresh();
        Artisan::call('tenants:artisan', [
            'artisanCommand' => 'migrate --database=tenant --seed --force',
            '--tenant' => "{$tenant->id}",
        ]);
    }
}
