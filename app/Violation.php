<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Violation extends Model
{
	protected $fillable = [
		'violator_identity_number', 'violator_name', 'station_id',
	];

    public function user() 
    {
    	return $this->belongsTo(User::class, 'officer_id');
    }
    public function station()
    {
    	return $this->belongsTo(Station::class, 'station_id');
    }
}
