<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function users(){
        return $this->hasMany(User::class);
    }
}
