<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use SoftDeletes;

    public function notebook ()
    {
        return $this->belongsTo('App\Notebook');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
