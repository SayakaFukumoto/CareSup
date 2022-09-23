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
        Schema::create('care_records', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('title',225)->nullable();
            $table->integer('customer_id')->default(0)->nullable();
            $table->string('detail',1024);
            $table->integer('type');
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
        Schema::dropIfExists('care_records');
    }
};
