<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    protected $table = 'subcategories';
    protected $fillable = ['categories_id','name'];

    public function category()
    {
        return $this->hasMany('App\category','categories_id'); // assuming this is the path for Log model
    }


    
}
