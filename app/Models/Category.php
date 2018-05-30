<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Category extends BaseModel
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',       
    ];
    protected $guarded = []; 

    public function books()
    {
        return $this->hasMany('App\Models\Book', 'category_id', 'id');
    }
}
