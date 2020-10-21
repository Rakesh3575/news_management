<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

  protected $fillable = ['parent_id', 'name'];
 
  public function children()
  {
    return $this->hasMany('App\Category', 'parent_id');  //get all subs. NOT RECURSIVE
  }

  public function parent() {
    return $this->belongsTo('App\Category', 'parent_id'); //get parent category
}




	public function news()
	{
	    return $this->hasMany('App\News');
	}
}
