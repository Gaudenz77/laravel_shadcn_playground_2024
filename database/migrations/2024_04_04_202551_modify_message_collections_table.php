<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMessageCollectionsTable extends Migration
{
    public function up()
    {
        Schema::table('message_collections', function (Blueprint $table) {
            // Remove existing columns
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('email');

            // Add new columns
            $table->string('title')->nullable();
            $table->text('leadtext')->nullable();
        });
    }

    public function down()
    {
        Schema::table('message_collections', function (Blueprint $table) {
            // Rollback changes if needed
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();

            $table->dropColumn('title');
            $table->dropColumn('leadtext');
        });
    }
}
