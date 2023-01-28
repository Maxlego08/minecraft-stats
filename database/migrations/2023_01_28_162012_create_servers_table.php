<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('ip');
            $table->integer('port')->default(25565);
            $table->integer('max_players')->default(0);
            $table->integer('online_record_players')->default(0);
            $table->string('icon')->nullable();
            $table->string('description')->nullable();
            $table->string('version')->nullable();
            $table->boolean('is_online',)->default(false);
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
        Schema::dropIfExists('servers');
    }
};
