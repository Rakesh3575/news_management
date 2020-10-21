<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
  	 protected $fillable = [
        'user_id','category_id','title', 'details','image','status'
    ];

     public function getRouteKeyName()
    {
        return 'slug';
    }
      
    public function user()
    {
        return $this->belongsTo('App\User');        
    }
    public function Like()
    {
        return $this->belongsTo('App\Like');        
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
