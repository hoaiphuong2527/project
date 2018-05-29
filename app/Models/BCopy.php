<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BCopy extends Model
{
    protected $table = 'book_copy';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'book_id',
        'amount',
    ];
    protected $guarded = []; 

}
