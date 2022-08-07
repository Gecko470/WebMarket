<?php

use App\Models\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->float('coste_envio');
            $table->float('total');
            $table->json('content');
            /* $table->string('address')->nullable(); */
            $table->string('observaciones')->nullable();
            $table->enum('tipo_recogida', [1, 2]);
            $table->enum('status', [0, 1, 2, 3, 4]);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            /* $table->unsignedBigInteger('ciudad_id')->nullable();
            $table->foreign('ciudad_id')->references('id')->on('ciudads');
            $table->unsignedBigInteger('provincia_id')->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincias'); */
            $table->json('envio')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
