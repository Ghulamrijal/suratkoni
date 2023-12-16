<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'role';
    protected $fillable = [
    	'nama_role',
    ];

    public function user(){
    	$this->hasOne('App\Models\User', 'role_id');
    }

}
