<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	
   protected $fillable = [
        'user_id', 'news_id','like'
    ];
    public function user()
    {
        return $this->belongsTo('App\User');        
    }
    public function News()
    {
        return $this->belongsTo('App\News');        
    }
}
