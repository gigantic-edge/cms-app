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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('description');
            $table->string('image');
            $table->integer('ranking')->length(11);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_deleted', ['0', '1'])->default('0')->comment('0=No,1=Yes');
            $table->timestamp('created_at')->useCurrent();
            $table->integer('created_by');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
