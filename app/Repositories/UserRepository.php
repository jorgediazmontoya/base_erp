<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Base\BaseRepository;

class UserRepository extends BaseRepository
{
    /**
     * __construct
     *
     * @return void
     */
    public function __construct (User $user) {
        parent::__construct($user);
    }

    /**
     * save
     *
     * @return void
     */
    public function save (Model $user) {
        $user->password = Hash::make($user->password);
        $user->save();
        return $user;
    }
}
