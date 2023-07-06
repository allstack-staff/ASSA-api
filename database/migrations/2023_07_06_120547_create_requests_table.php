<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->unsignedBigInteger('squad_origin_id');
            $table->unsignedBigInteger('squad_origin_user_id');
            $table->unsignedBigInteger('demand_id')->nullable();
            $table->string('name');
            $table->text('description');
            $table->enum('priority', ['Low', 'Medium', 'High']);
            $table->enum('status', ['Accepted', 'Refused', 'Under review']);
            $table->date('deadline')->nullable();
            $table->timestamps();

            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');

            $table->foreign('squad_origin_id')
                ->references('id')
                ->on('squads')
                ->onDelete('cascade');

            $table->foreign('squad_origin_user_id')
                ->references('id')
                ->on('squad_users')
                ->onDelete('cascade');

            $table->foreign('demand_id')
                ->references('id')
                ->on('demands')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
