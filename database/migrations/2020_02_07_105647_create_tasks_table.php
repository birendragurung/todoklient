<?php

use App\Constants\AppConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('todo_db')->create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 191);
            $table->enum('state' , [
                AppConstants::TASK_STATES ,
            ]);
            $table->bigInteger('assignee');
            $table->bigInteger('created_by');
            $table->bigInteger('updated_by');
            $table->softDeletes();
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
        Schema::connection('todo_db')->dropIfExists('tasks');
    }
}
