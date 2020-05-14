<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function carts(){
        return $this->belongsToMany(Cart::class)
                    ->withPivot('quantity','bought')
                    ->withTimestamps();
    }

    public function category(){
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function district(){
        return $this->belongsTo(District::class);
    }
}
