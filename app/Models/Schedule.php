<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['event', 'open', 'close'];

    // No relationships defined in this example
}
