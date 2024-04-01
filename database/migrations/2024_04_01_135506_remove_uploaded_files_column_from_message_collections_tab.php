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
        Schema::table('message_collections', function (Blueprint $table) {
            $table->dropColumn('uploaded_files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('message_collections', function (Blueprint $table) {
            $table->string('uploaded_files')->nullable();
        });
    }
};
