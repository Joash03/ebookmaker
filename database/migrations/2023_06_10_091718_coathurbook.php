<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('coauthorbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('users');
            $table->string('title');
            $table->text('description');
            $table->string('cover')->nullable();
            $table->string('content')->nullable();
            $table->enum('status', ['complete', 'incomplete'])->default('incomplete');
            $table->timestamps();
        });

        Schema::create('coauthorbook_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('coauthorbook_id')->constrained('coauthorbooks')->onDelete('cascade');
            $table->foreignId('coauthorbooks_author')->constrained('users')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('users')->default(0)->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('coauthorbook_user');
        Schema::dropIfExists('coauthorbooks');
    }
};
