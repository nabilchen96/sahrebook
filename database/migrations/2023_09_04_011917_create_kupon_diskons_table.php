<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuponDiskonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kupon_diskons', function (Blueprint $table) {
            $table->id();
            $table->string('kode_kupon');
            $table->string('nama_kupon');
            $table->integer('total_diskon');
            $table->integer('minimal_belanja');
            $table->string('status_kupon');
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
        Schema::dropIfExists('kupon_diskons');
    }
}
