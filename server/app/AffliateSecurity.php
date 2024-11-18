<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffliateSecurity extends Model
{
	 protected $guarded = [];
    protected $fillable = [
    'affliate_id'
];

public function affliate()
{
    return $this->belongsTo('App\Affliate');
}
}
