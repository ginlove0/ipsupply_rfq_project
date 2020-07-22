<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    //

    protected $table = 'quotation';

    protected $fillable = ['userId', 'modelId', 'qty', 'condition', 'price', 'note', 'free_shipping', 'serialNumber'];

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class, 'userId', 'id');
    }

    public function models():BelongsTo
    {
        return $this->belongsTo(ModelDetail::class, 'modelId', 'id');
    }
}
