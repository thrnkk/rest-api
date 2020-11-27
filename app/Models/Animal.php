<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
	protected $table  = "animal";
    protected $fillable = ['name', 'breed', 'specie'];

    public function customers(){
	    return $this->belongsToMany(Customer::class);
	}

}
