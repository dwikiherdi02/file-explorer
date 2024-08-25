<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('fileable');
            $table->string('filename', 100);
            $table->string('filename_ori', 100);
            $table->text('path');
            $table->string('icon', 100);
            $table->string('extension', 5);
            $table->string('mime_type', 20);
            $table->integer('size')->unsigned();
            $table->integer('width')->unsigned()->nullable();
            $table->integer('heigth')->unsigned()->nullable();
            $table->enum('orientation', ['portrait', 'landscape', 'square'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
