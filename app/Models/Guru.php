<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['nama', 'foto', 'alamat'];

    // No relationships defined in this example
}
