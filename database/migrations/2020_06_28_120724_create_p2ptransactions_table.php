<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateP2ptransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p2ptransactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('order_id');
            $table->string('receiver_user_id');
            $table->string('sendCurrency');
            $table->string('sendAmount');
            $table->string('receiveAmount');
            $table->string('receiveCurrency');
            $table->boolean('sent');
            $table->boolean('received');
            $table->string('tid');
            $table->string('crossTnx_id');
            $table->index('user_id');
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
        Schema::dropIfExists('p2ptransactions');
    }
}
