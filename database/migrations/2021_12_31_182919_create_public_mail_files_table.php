<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicMailFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('public_mail_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('public_mail_id')->constrained('public_mail')->onUpdate('cascade')->onDelete('cascade');
            $table->text('file_path');
            $table->tinyInteger('file_save_path')->default(0)->comment('0 => public, 1 => storage');
            $table->bigInteger('file_size');
            $table->string('file_type');
            $table->string('file_name');
            $table->string('file_description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('public_mail_files');
    }
}
