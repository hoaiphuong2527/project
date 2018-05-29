<?php

namespace App\Repositories;
use App\Models\Category;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class CategoryRepository extends BaseRepository
{
    public function __construct(Category $category) 
    {
        $this->model = $category;
    }

    public function getAll($search_query)
    {
        $objs = $search_query->paginate(20);
        return $objs;
    }

}