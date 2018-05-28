<?php

namespace App\Repositories;
use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class UserRepository extends BaseRepository
{
    public function __construct(User $user) 
    {
        $this->model = $user;
    }

    public function getAll($search_query)
    {
        $users = $search_query->paginate(20);
        return $users;
    }

   


   
}