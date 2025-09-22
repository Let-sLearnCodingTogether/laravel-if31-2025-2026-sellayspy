<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'spot_id',
        'category',
    ];

    public function spot(){
        return $this->belongsTo(Spot::class);
    }
}
