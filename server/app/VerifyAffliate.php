<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyAffliate extends Model
{
    
    protected $guarded = ['affliate'];
 
    public function affliate()
    {
        return $this->belongsTo('App\Affliate', 'affliate_id');
    }
}
