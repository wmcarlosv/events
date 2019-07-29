<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = ['user_id','title','description','cover','event_date','status'];

    public function user(){
    	return $this->belongsTo('App\User');
    }
}
