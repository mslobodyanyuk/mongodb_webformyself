<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Article extends Eloquent
{
    protected $collection = 'articles';
    protected $fillable = ['title', 'text', 'author'];
    
    public function category()
    {    
        return $this->belongsTo('App\Category');        
    }
}
