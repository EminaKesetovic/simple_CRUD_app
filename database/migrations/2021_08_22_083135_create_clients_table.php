<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 250)->nullable();
            $table->string('address', 250);
            $table->integer('city_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('industry_type_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('city_id')
                  ->references('id')
                  ->on('cities');

            $table->foreign('country_id')
                  ->references('id')
                  ->on('countries');

            $table->foreign('industry_type_id')
                  ->references('id')
                  ->on('industry_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
