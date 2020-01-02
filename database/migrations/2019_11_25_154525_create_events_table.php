<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('counter_id')->index();

            $table->string('client_id', 255)->nullable();
            $table->string('client_name', 255)->nullable();
            $table->unsignedTinyInteger('status_code')->default(0);
            $table->string('status_remark', 255)->nullable();

            $table->timestamp('generated_at')->nullable();
            $table->timestamp('created_at', 0)->nullable();

            $table->foreign('counter_id')
                ->references('id')
                ->on('counters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
