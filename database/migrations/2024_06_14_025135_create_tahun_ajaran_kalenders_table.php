<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAjaranKalendersTable extends Migration
{
    public function up()
    {
        Schema::create('tahun_ajaran_kalenders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('color')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tahun_ajaran_kalenders');
    }
}
