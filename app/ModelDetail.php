<?php

namespace App;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;

class ModelDetail extends Model
{
    //

    protected $table = 'model_detail';

    protected $fillable = ['name', 'condition', 'qty', 'note', 'meta', 'serialRequired', 'created_at', 'updated_at'];

    protected $casts = [
        'meta' => 'array'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
