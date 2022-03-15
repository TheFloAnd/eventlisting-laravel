<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('not_applicable')->nullable();
            $table->string('event');
            $table->string('team');
            $table->datetime('start');
            $table->datetime('end');
            $table->integer('repeat')->nullable();
            $table->string('repeat_parent', 13)->nullable();
            $table->integer('repeat_dif')->nullable();
            $table->string('room')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
