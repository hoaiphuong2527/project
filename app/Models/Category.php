<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';
    
    protected $fillable = [
        'name'
    ];
    protected $guarded = []; 

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
}
