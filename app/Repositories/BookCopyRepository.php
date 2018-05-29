<?php

namespace App\Repositories;

use App\Models\BCopy;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class BookCopyRepository extends BaseRepository
{
    public function __construct(BCopy $bCopy) 
    {
        $this->model = $bCopy;
    }

    public function getAll($search_query)
    {
        $objs = $search_query->paginate(20);
        return $objs;
    }

}