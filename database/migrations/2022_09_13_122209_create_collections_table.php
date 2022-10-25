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
        Schema::create('collections', function (Blueprint $table) {
            $table->id()->index();
            $table->string('slug')->unique()->nullable()->index();
            $table->foreignId('created_by')->default('0')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->string('status')->index();
            $table->string('title')->index();
            $table->string('cover_path')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('collections');
    }
};
