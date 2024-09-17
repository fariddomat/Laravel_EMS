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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // العمود user_id كـ foreign key
            $table->enum('type', ['person', 'website']); // العمود type
            $table->string('roles'); // العمود roles يحتوي على قائمة الأدوار
            $table->string('name'); // العمود name
            $table->text('description'); // العمود description
            $table->json('images')->nullable(); // العمود images يحتوي على قائمة الصور بتنسيق JSON
            $table->json('videos')->nullable(); // العمود videos يحتوي على قائمة الفيديوهات بتنسيق JSON
            $table->timestamps(); // العمودين created_at و updated_at

            // Foreign key constraint على user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
