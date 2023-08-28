<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->String('ip_address')->nullable();
            $table->String('user_agent')->nullable();
            $table->String('provider')->nullable();
            $table->String('location')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->String('os')->nullable();
            $table->String('page_url')->nullable();
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
        Schema::dropIfExists('visitors');
    }
}
