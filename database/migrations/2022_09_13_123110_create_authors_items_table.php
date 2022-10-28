<?php

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
        Schema::create('author_item', function (Blueprint $table) {
            $table->id()->index();
            $table->integer('author_id')->index();
            $table->integer('item_id')->index();
            $table->string('contribution')->nullable();
            $table->unique(['author_id', 'item_id']);
            $table->index(['author_id', 'item_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('author_item');
    }
};
