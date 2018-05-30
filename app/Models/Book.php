<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Book extends BaseModel
{
    protected $table = 'books';

    protected $primaryKey = 'id';

    protected $fillable = [
        'title',
        'author',
        'category_id',
        'type'
    ];
    protected $guarded = []; 

    public function user()
    {
        return $this->belongsToMany('App\Models\User')->withPivot('flag');
        ;
    }
    
    public function getBookByFlag()
    {
        $obj = new Book_User();

       return $list_obj_flag_false = $obj->getItemFlagIsFalse();

    }

    
}
