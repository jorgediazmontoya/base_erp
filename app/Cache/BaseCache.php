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
    public function __construct (Object $baseRepository, string $key) {
        $this->repository = $baseRepository;
        $this->key = $key;
        $this->cache = new Cache();
    }
}
