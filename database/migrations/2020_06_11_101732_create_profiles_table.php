<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('number1')->nullable();
            $table->string('number2')->nullable();
            $table->text('description')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('pst')->nullable();
            $table->string('directIncome')->nullable();
            $table->string('levelIncome')->nullable();
            $table->string('usdt')->nullable();
            $table->string('income')->nullable();
            $table->string('availablePST')->nullable();
            $table->string('availableUSDT')->nullable();
            $table->string('postcode')->nullable();
            $table->boolean('activated');
            $table->timestamps();
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
