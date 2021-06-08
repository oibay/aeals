<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id');
            $table->integer('passport');
            $table->string('room')->nullable();
            $table->enum('room_type',[
                'Гостиница стандарт','Общежитие','Гостиница люкс','Гостиница полулюкс'
            ]);
            $table->string('vouchers')->default(0);
            $table->string('phone');
            $table->integer('status')->default(1);

            $table->string('location')->default('apec');
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
        Schema::dropIfExists('guests');
    }
}
