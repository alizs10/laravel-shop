<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertisementBanersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisement_baners', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('image');
            $table->string('url');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('position')->comment('0 => slideshow, 1 and more based on what developer wants');
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
        Schema::dropIfExists('advertisement_baners');
    }
}
