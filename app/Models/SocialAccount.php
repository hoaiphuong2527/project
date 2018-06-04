<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends BaseModel
{
    protected $table = 'social_accounts';

    protected $primaryKey = 'id';

    protected $fillable = [
        'type',
        'user_id'
    ];
    protected $guarded = []; 
    
}
