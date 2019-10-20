<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRouteUsageTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('route_usage', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('identifier', 40);
            $table->string('method', 12);
            $table->text('path');
            $table->unsignedSmallInteger('status_code');
            $table->text('action')->nullable();
            $table->timestamps();

            $table->unique('identifier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('route_usage');
    }
}
