<?php

namespace App\Repositories;
use App\Models\BookItem;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Schema;

class BookItemRepository extends BaseRepository
{
    public function __construct(BookItem $book_item) 
    {
        $this->model = $book_item;
    }   


   
}