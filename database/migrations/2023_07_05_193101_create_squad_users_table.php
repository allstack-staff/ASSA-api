<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSquadUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('squad_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('squad_id');
            $table->unsignedBigInteger('user_id');
            $table->enum('role', ['Member', 'Coordinator']);
            $table->timestamps();

            $table->foreign('squad_id')
                ->references('id')
                ->on('squads')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('squad_users');
    }
}
