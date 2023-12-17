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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->integer('id_category_project');
            $table->integer('ord')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('highlight')->default(0);
            $table->text('url_avatar');
            $table->text('url_avatar_mobile');
            $table->text('url_bg')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->text('desc')->nullable();
            $table->longText('content')->nullable();
            $table->text('meta_image');
            $table->string('meta_title');
            $table->text('meta_desc');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
