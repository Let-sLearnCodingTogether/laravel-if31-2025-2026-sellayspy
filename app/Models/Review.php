<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'spot_id',
        'user_id',
        'content',
        'rating',
    ];

    public function spot(){
        return $this->belongsTo(Spot::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
