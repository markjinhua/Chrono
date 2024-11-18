<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class VerifyPublisher extends Model
{
    
    protected $guarded = ['publisher'];
 
    public function publisher()
    {
        return $this->belongsTo('App\Publisher', 'publisher_id');
    }
}
