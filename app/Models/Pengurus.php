<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengurus extends Model
{
    protected $table = 'penguruses';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['nis', 'foto', 'nama', 'jenis_kelamin', 'nomor_tlp', 'alamat'];

    // Relationship with Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'nis', 'nis');
    }
}
