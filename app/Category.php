<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Category extends Eloquent
{
    protected $collection = 'category';
    protected $fillable = ['title'];
    
    public function articles()
    {    
        return $this->hasMany('App\Article');        
    }
}
