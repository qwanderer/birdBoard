<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->unsignedInteger("project_id");
            $table->string("description");

            $table->foreign("project_id")->references("id")->on("projects")->onDelete("cascade");
            // ->onDelete("cascade") - Если удалят ПРОЕКТ то удалятся и все связанные с ним активити
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activities');
    }
}
