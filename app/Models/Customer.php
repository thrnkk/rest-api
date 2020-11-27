<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
	protected $table  = "customer";
    protected $fillable = ['name', 'email', 'age'];

    public function animals(){
	    return $this->belongsToMany(Animal::class);
	}
}
