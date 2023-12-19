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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->text('url_avatar_full');
            $table->text('url_avatar_icon');
            $table->text('url_favicon');
            $table->text('url_video');
            $table->text('meta_title');
            $table->text('meta_image');
            $table->text('meta_desc');
            $table->text('time_start');
            $table->text('time_end');
            $table->text('website');
            $table->text('name');
            $table->text('short_name');
            $table->text('phone');
            $table->text('hotline');
            $table->text('mail');
            $table->text('support_mail');
            $table->text('slogan');
            $table->text('sub_slogan');
            $table->text('zalo');
            $table->text('facebook');
            $table->text('youtube');
            $table->text('intagrams');
            $table->text('about');
            $table->text('province');
            $table->text('district');
            $table->text('ward');
            $table->text('address');

            $table->timestamps();
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
