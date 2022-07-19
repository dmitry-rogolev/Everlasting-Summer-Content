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
        Schema::table("dislikes", function(Blueprint $table)
        {
            $table->unsignedBigInteger("comment_id")->nullable()->after("content_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("dislikes", function(Blueprint $table)
        {
            $table->dropColumn("comment_id");
        });
    }
};
