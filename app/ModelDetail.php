<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelDetail extends Model
{
    //

    protected $table = 'model_detail';

    protected $fillable = ['name', 'condition', 'qty', 'note', 'meta', 'serialRequired'];

    protected $casts = [
        'meta' => 'array'
    ];
}
