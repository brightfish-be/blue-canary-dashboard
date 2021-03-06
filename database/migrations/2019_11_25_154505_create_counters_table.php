<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountersTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        $config = config('canary.settings.counter');
        $max = $config['name_length_max'];

        Schema::create('counters', function (Blueprint $table) use ($max) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('app_id')->index();

            $table->string('name', $max);

            $table->timestamps();

            $table->unique(['app_id', 'name']);

            $table->foreign('app_id')
                ->references('id')
                ->on('apps')
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
        Schema::dropIfExists('counters');
    }
}
