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
        Schema::table("avatars", function(Blueprint $table)
        {
            $table->dropColumn("hash");
            $table->dropColumn("name");
            $table->tinyText("title")->nullable()->after("id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("avatars", function(Blueprint $table)
        {
            $table->dropColumn("title");
            $table->string("name")->nullable()->after("id");
            $table->string("hash")->nullable()->after("name");
        });
    }
};
