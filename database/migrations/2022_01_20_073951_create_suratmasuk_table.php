<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratmasukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suratmasuk', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_pengirim',100);
            $table->string('nomor_surat',100);
            $table->string('perihal',200);
            $table->string('klasifikasi',200);
            $table->string('disposisi',100);
            $table->string('file')->nullable();
            $table->string('ket_disposisi',300);
            $table->string('tindak_lanjut',300);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suratmasuk');
    }
}
