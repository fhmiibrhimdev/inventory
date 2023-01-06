<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_barang', function (Blueprint $table) {
            $table->id();
            $table->text('id_user');
            $table->text('gambar');
            $table->text('kode_item');
            $table->text('nama_item');
            $table->text('id_jenis');
            $table->text('id_merek');
            $table->text('id_satuan');
            $table->text('id_kategori');
            $table->text('id_rak');
            $table->text('keterangan');
            $table->text('stock');
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
        Schema::dropIfExists('data_barang');
    }
}
