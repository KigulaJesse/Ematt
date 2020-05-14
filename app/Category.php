<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function products(){

        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function sub_category(){
        return $this->hasMany('App\Category','parent_id');
    }
}
