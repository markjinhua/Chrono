<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginSecurity extends Model
{
	 protected $guarded = [];
    protected $fillable = [
    'publisher_id'
];

public function publisher()
{
    return $this->belongsTo('App\Publisher');
}
}
