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
        Schema::create('items', function (Blueprint $table) {

            $table->id()->index();
            $table->string('slug')->unique()->nullable()->index();
            $table->foreignId('created_by')->default('0')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->integer('status')->default(0)->index();
            $table->string('title')->index();
            $table->text('title_long')->nullable();
            $table->string('cover_path')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publisher_day')->nullable();
            $table->string('publisher_month')->nullable();
            $table->string('publisher_year')->nullable();
            $table->string('publisher_where')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable()->index();
            $table->string('language')->nullable();
            $table->string('provider')->nullable();
            $table->string('rights')->nullable();
            $table->string('ISBN')->nullable();
            $table->string('ISSN')->nullable();
            $table->timestamps();
            $table->index(['created_at', 'status']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
