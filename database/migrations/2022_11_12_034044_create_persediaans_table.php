<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersediaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('persediaan', function (Blueprint $table) {
            $table->id();
            $table->text('id_user');
            $table->text('tanggal');
            $table->text('id_barang');
            $table->text('qty');
            $table->text('keterangan');
            $table->text('buku')->default('-');
            $table->text('fisik')->default('-');
            $table->text('selisih')->default('-');
            $table->text('opname')->default('no');
            $table->text('status');
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
        Schema::dropIfExists('persediaan');
    }
}
