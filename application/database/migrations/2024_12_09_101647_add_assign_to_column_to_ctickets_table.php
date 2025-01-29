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
        Schema::table('ctickets', function (Blueprint $table) {
            $table->text('assign_to')->nullable(); // Or use JSON if needed
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('ctickets', function (Blueprint $table) {
            $table->dropColumn('assign_to');
        });
    }
};
