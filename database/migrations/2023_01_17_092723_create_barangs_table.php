<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('KdObat')->unique();
            $table->string('NmObat')->nullable();
            $table->string('Jenis')->nullable();
            $table->string('Satuan')->nullable();
            $table->string('HargaBeli')->nullable();
            $table->string('HargaJual')->nullable();
            $table->double('Stok')->default(0);
            $table->string('KdSuplier')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang');
    }
}
