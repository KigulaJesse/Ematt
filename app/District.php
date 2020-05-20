<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function users(){
        return $this->hasMany(User::class);
    }

    public function sub_locations(){
        return $this->hasMany('App\District','parent_id');
    }
}
