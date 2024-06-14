<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataLoginsTable extends Migration
{
    public function up()
    {
        Schema::create('data_logins', function (Blueprint $table) {
            $table->string('username')->primary();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['user', 'admin']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('data_logins');
    }
}
