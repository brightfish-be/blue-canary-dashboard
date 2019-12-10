<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        $config = config('canary.settings.counter');
        $max = $config['name_length_max'];

        Schema::create('apps', function (Blueprint $table) use ($max) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('tenant_id')->index();

            $table->string('name', $max);
            $table->uuid('uuid')->unique();

            $table->timestamps();

            $table->foreign('tenant_id')
                ->references('id')
                ->on('tenants')
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
        Schema::dropIfExists('apps');
    }
}
