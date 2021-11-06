<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('accounts_id');
            $table->integer("is_verified")->default(0);
            $table->string("verified_at")->nullable();
            $table->string("amount")->nullable();
            $table->string("verified_amount")->nullable();
            $table->string("desc")->nullable();
            $table->unsignedBigInteger("verified_by")->nullable();
            $table->string("show_as")->nullable();
            $table->text("message")->nullable();
            $table->string("photo")->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('accounts_id')->references('id')->on('donation_accounts')->onDelete('cascade');
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
        Schema::dropIfExists('donasis');
    }
}
