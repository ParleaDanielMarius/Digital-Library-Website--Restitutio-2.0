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

            $table->id();
            $table->foreignId('created_by')->default('0')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->string('status')->default('Inactive');
            //$table->foreignId('member_of')->default('0')->constrained('collections'); - DEPRECATED
            $table->string('title');
            $table->text('title_long')->nullable();
            //$table->foreignId('author_id')->default('0')->constrained('authors'); - DEPRECATED
            $table->string('cover_path')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('publisher')->nullable();
            $table->string('publisher_when')->nullable();
            $table->string('publisher_where')->nullable();
            $table->longText('description')->nullable();
            $table->string('type')->nullable();
            //$table->string('subjects')->nullable(); - DEPRECATED
            $table->string('language')->nullable();
            $table->string('provider')->nullable();
            $table->string('rights')->nullable();
            $table->string('ISBN')->nullable();
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
        Schema::dropIfExists('items');
    }
};
