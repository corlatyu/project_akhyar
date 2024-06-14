<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSantrisTable extends Migration
{
    public function up()
    {
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->string('nis', 6)->unique();
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->string('nik', 16)->unique();
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('kamar');
            $table->string('jenjang');
            $table->string('tempat_lahir');
            $table->date('tgl_lahir');
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kabupaten');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('nomor_tlp_ortu', 15);
            $table->string('no_kk', 16);
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('santris');
    }
}