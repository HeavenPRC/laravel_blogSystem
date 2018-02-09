<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['name', 'boos_id'];

    public function boostag()
    {
    	return $this->belongsTo(Boostag::class);
    }

}
