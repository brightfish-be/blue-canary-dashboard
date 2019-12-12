<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        $defaultHost = parse_url(config('app.url'), PHP_URL_HOST);

        Schema::create('tenants', function (Blueprint $table) use ($defaultHost) {
            $table->bigIncrements('id');

            $table->string('name', 255);
            $table->string('host', 255)->default($defaultHost);
            $table->string('country', 255)->nullable();
            $table->string('lang', 2)->default('en');
            $table->string('logo', 255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
