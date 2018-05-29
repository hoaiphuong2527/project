<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',       
    ];
    protected $guarded = []; 

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }
    
    public function destroyCate($id)
	{
		$obj = Category::find((int) $id);
        $obj->delete();
    }

    public function findCate($id)
    {
        return Category::find((int) $id);
    }

}
