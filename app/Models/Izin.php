<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $table = 'izins';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = ['nis', 'nama', 'tgl_pulang', 'tgl_kembali', 'status', 'nomor_tlp_ortu', 'alamat'];

    // Relationship with Santri
    public function santri()
    {
        return $this->belongsTo(Santri::class, 'nis', 'nis');
    }
}
