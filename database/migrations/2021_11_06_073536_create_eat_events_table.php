<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEatEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
    "_token": "lsVoFGD7y9DHzI8wVSscm0YNCF84Dp1ZABOBSo4b",
    "offline_quotas": "67",
    "online_quotas": "100",
    "food": "Ayam Bakar Ciwalini",
    "time_start": "2021-11-06T16:59",
    "time_end": "2021-11-07T16:59",
    "lat": "-6.241586",
    "long": "106.992416",
    "pic_contact": "088223738741",
    "pic_name": "Subhan Bawazier",
    "status": "1",
    "m_description": "<p>Ini Adalah Deskripsi</p>",
    "photo": {

    }
     * @return void
     */
    public function up()
    {
        Schema::create('eat_events', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('offline_quotas')->nullable();
            $table->string('online_quotas')->nullable();
            $table->string('food')->nullable();
            $table->string('time_start')->nullable();
            $table->string('time_end')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('pic_contact')->nullable();
            $table->string('pic_name')->nullable();
            $table->string('status')->nullable();
            $table->string('photo')->nullable();
            $table->string('m_description')->nullable();
            $table->string('is_deleted')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->foreign('deleted_by')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('created_by')->references('id')->on('users')->cascadeOnDelete();
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
        Schema::dropIfExists('eat_events');
    }
}
