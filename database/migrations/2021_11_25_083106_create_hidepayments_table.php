<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHidepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hidepayments', function (Blueprint $table) {
            $table->id();
            $table->string('version');
            $table->string('isUpStoreAndroid');
            $table->string('isUpStoreIos');
            $table->string('api_status');
            $table->string('error_mesg')->nullable();
            $table->bigInteger('created_by')->nullable()->unsigned();
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
        Schema::dropIfExists('hidepayments');
    }
}
