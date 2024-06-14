<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIzinsTable extends Migration
{
    public function up()
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nis');
            $table->string('nama');
            $table->date('tgl_pulang');
            $table->date('tgl_kembali');
            $table->string('status')->nullable();
            $table->string('nomor_tlp_ortu')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('santris')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('izins');
    }
}
