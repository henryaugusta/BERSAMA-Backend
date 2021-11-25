<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLinkToEatEventDocumentations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eat_event_documentations', function (Blueprint $table) {
            $table->string('link_vid')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eat_event_documentations', function (Blueprint $table) {
            $table->dropColumn('link_vid');
        });
    }
}
