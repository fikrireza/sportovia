<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'amd_role';

    protected $fillable = ['title','slug'];


    public function users()
  	{
  	  return $this->hasMany('App\Models\User');
  	}

    public function admins()
  	{
  	  return $this->hasMany('App\Models\Admin');
  	}
}
