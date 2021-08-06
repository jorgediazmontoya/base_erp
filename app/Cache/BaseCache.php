<?php

namespace App\Cache;

use Illuminate\Support\Facades\Cache;
use App\Repositories\Base\BaseRepository;
use App\Repositories\Contracts\IBaseRepository;

abstract class BaseCache implements IBaseRepository {

    const TTL = 86400;
    protected $repository;
    protected $key;
    protected $cache;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct (Object $baseRepository) {
        $key = request()->url();
        $queryParams = request()->query();

        ksort($queryParams);
        $queryString = http_build_query($queryParams);
        $fullUrl = "{$key}?{$queryString}";

        $this->repository = $baseRepository;
        $this->key = $fullUrl;
        $this->cache = new Cache();
    }
}
