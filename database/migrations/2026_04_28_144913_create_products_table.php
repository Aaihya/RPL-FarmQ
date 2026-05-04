<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
         $table->id();
         $table->string('name');
         $table->enum('type', ['Sapi','Kambing','Domba']);
         $table->integer('price');
         $table->integer('weight');
         $table->integer('age');
         $table->string('location');
         $table->text('health_status');
         $table->string('image')->nullable();
         $table->boolean('is_sold')->default(false);
         $table->foreignId('user_id')->constrained()->onDelete('cascade');
         $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
