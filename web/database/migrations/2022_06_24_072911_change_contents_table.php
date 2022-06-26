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
        Schema::table("contents", function(Blueprint $table)
        {
            $table->bigInteger("folder_id")->unsigned()->nullbale()->after("type");
            $table->dropColumn("name");
            $table->dropColumn("hash");
            $table->dropColumn("title");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("contents", function(Blueprint $table)
        {
            $table->dropColumn("folder_id");
            $table->string("name")->nullable()->after("title");
            $table->string("hash")->nullable()->after("name");
            $table->string("title")->nullable()->after("id");
        });
    }
};
