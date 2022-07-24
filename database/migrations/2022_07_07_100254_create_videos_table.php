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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->onDelete('cascade')->onUpdate('cascade');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('uid');
            $table->integer('views')->default(0);
            $table->string('path')->nullable();
            $table->string('processed_file')->nullable();
            $table->string('processing_percentage')->nullable();
            $table->enum('visibility', ['private', 'public', 'unlisted'])->default('private');
            $table->boolean('processed')->default(false);
            $table->boolean('allow_likes')->default(true);
            $table->boolean('allow_comments')->default(true);
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
        Schema::dropIfExists('videos');
    }
};
