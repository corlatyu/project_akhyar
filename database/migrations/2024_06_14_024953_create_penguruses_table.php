<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengurusesTable extends Migration
{
    public function up()
    {
        Schema::create('penguruses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nis');
            $table->string('foto')->nullable();
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('nomor_tlp')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();

            $table->foreign('nis')->references('nis')->on('santris')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penguruses');
    }
}
