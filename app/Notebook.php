<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notebook extends Model
{
    use SoftDeletes;

    public function notes ()
    {
        return $this->hasMany('App\Note');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
