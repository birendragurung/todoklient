<?php

use App\Constants\AppConstants;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('title' , 191);
            $table->string('description' , 191);
            $table->unsignedBigInteger('user_id');
            $table->enum('type' , AppConstants::NOTIFICATION_TYPES);
            $table->json('data');
            $table->json('extra');
            $table->string('entity_type' , 191);
            $table->unsignedBigInteger('entity_id');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index('user_id' , 'notifications_user_id_index');
            $table->index(['entity_type' , 'entity_id'] , 'notifications_entity_type_entity_id_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
