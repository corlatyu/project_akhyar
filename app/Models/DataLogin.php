<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataLogin extends Model
{
    protected $table = 'data_logins';
    protected $primaryKey = 'username'; // karena primary keynya username
    public $incrementing = false; // karena primary key bukan auto increment
    public $timestamps = true;

    protected $fillable = ['username', 'email', 'password', 'role'];

    // No relationships defined in this example
}
