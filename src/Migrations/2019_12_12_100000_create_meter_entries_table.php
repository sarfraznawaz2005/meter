<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeterEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_entries', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type', 20);
            $table->enum('is_slow', ['No', 'Yes'])->default('No');
            $table->longText('content');
            $table->dateTime('created_at')->nullable();

            $table->index(['type']);
            $table->index(['created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meter_entries');
    }
}
