<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('message_collections', function (Blueprint $table) {
            $table->string('image')->nullable()->after('message');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('message_collections', function (Blueprint $table) {
            $table->dropColumn('image');
        });
    }
};
