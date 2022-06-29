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
            $table->text("path")->nullable()->collation("utf8mb4_bin")->after("type");
            $table->string("name", 255)->nullable()->after("id");
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
            $table->dropColumn("path");
            $table->dropColumn("name");
        });
    }
};
