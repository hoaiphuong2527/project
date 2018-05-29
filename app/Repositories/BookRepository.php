<?php

namespace App\Repositories;
use App\Models\Book;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class BookRepository extends BaseRepository
{
    public function __construct(Book $book) 
    {
        $this->model = $book;
    }

    public function getAll($search_query)
    {
        $objs = $search_query->paginate(20);
        return $objs;
    }

   


   
}