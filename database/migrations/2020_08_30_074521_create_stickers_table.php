<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStickersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickers', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('letter_id');
            $table->foreign('letter_id')->references('id')->on('letters')->onDelete('cascade');
            $table->string('serialize')->unique();
            $table->string('serial_number');
            $table->string('sticker_type');
            $table->string('unit_name');
            $table->string('military_number');
            $table->string('rank');
            $table->string('person_name');
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
        Schema::dropIfExists('stickers');
    }
}
