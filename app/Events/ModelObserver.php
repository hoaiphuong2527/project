<?php

namespace App\Events;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;
use App\Utils\SessionManager;

class ModelObserver
{
    private $userId = null;
    function __constructor() {
        if (Auth::user() != null) {
            $userId = Auth::user()->id;
        }
    }
    /**
     * Listen to the Model creating event.
     *
     * @param  Model  $model
     * @return void
     */
    public function creating(Model $model)
    {
        if(Schema::hasColumn($model->getTable(), "created_by")) {
            $model->created_by = Auth::user()->id;
        }
        if(Schema::hasColumn($model->getTable(), "created_at")) {
            $model->created_at = date('Y-m-d h:i:s');
        }
        if(Schema::hasColumn($model->getTable(), "updated_by")) {
            $model->updated_by = Auth::user()->id;
        }
        if(Schema::hasColumn($model->getTable(), "updated_at")) {
            $model->updated_at = date('Y-m-d h:i:s');
        }
    }

    /**
     * Listen to the Model updating event.
     *
     * @param  Model  $model
     * @return void
     */
    public function updating(Model $model)
    {
        if(Schema::hasColumn($model->getTable(), "updated_by")) {
            $model->updated_by = Auth::user()->id;
        }
        if(Schema::hasColumn($model->getTable(), "updated_at")) {
            $model->updated_at = date('Y-m-d h:i:s');
        }
    }
    
}