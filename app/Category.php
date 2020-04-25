<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products(){

        return $this->hasMany(Product::class);
    }

    public function sub_category(){
        return $this->hasMany('App\Category','category_id');
    }
}
