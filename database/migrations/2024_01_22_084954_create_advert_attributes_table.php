<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('advert_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->references('id')->on('advert_categories')->onDelete('CASCADE');
            $table->string('name');
            $table->string('type');
            $table->boolean('required');
            $table->json('variants');
            $table->integer('sort');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advert_attributes');
    }
};
