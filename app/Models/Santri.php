<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Santri extends Model
{
    protected $table = 'santris';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nis', 'foto', 'nama', 'nik', 'jenis_kelamin', 'kamar', 'jenjang',
        'tempat_lahir', 'tgl_lahir', 'alamat', 'provinsi', 'kabupaten', 'nama_ayah',
        'nama_ibu', 'nomor_tlp_ortu', 'no_kk', 'status'
    ];

    // Relationships
    public function penguruses()
    {
        return $this->hasMany(Pengurus::class, 'nis', 'nis');
    }

    public function izins()
    {
        return $this->hasMany(Izin::class, 'nis', 'nis');
    }
}