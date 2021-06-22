<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignedUsersToOwnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('assigned_owners', function (Blueprint $table) {
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('user_id');
        });

        Schema::table('assigned_owners', function (Blueprint $table) {
            $table->foreign('owner_id', 'owner_id_fk')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('assigned_owners', function (Blueprint $table) {
            $table->foreign('user_id', 'user_id_fk')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign('owner_id_fk');
            $table->dropForeign('user_id_fk');
        });

        Schema::dropIfExists('assigned_owners');
    }
}
