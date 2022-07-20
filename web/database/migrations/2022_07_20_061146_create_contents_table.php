<?php

use App\Models\Folder;
use App\Models\User;
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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255)->collation("utf8mb4_bin")->nullable();
            $table->string("title", 255)->collation("utf8mb4_bin")->nullable();
            $table->string("extension", 255)->nullable();
            $table->string("type", 255)->nullable();
            $table->text("path")->collation("utf8mb4_bin")->nullable();
            $table->text("tags")->nullable();
            $table->text("description")->nullable();
            $table->boolean("visibility")->nullable();
            $table->foreignIdFor(Folder::class)->nullable();
            $table->foreignIdFor(User::class)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
};
