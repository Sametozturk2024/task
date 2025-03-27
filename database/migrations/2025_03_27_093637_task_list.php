<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TaskList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       schema::create("task_list", function (Blueprint $table) {
           $table->increments("id");
           $table->string("name");
           $table->string("description");
           $table->string("status")->default("active");
           $table->integer("user_id")->constrained()->onDelete('cascade');
           $table->timestamps();

       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        schema::dropIfExists("task_list");
    }
}
