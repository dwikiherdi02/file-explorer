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
        Schema::create('directories', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('parent_id')->nullable();
            $table->enum('root_dir', ['Documents', 'Music', 'Pictures', 'Videos'])->nullable();
            $table->string('name', 255)->unique();
            $table->string('image', 100)->default('storage/icons/folder.png');
            $table->json('breadcrumbs')->nullable();
            $table->boolean('is_root')->default(false);
            $table->timestamps();
            $table->primary('id', 'directories_id_primary');
            $table->index('parent_id', 'directories_parent_id_index');
            $table->index('root_dir', 'directories_root_dir_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('directories');
    }
};
