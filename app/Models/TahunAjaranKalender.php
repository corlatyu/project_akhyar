<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TahunAjaranKalender extends Model
{
    protected $table = 'tahun_ajaran_kalenders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['title', 'color', 'start_date', 'end_date'];

    // No relationships defined in this example
}
