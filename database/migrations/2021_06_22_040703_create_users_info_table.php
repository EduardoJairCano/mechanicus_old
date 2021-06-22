<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('users_info', function (Blueprint $table) {
            $table->id();
            $table->string('rfc',20)->nullable();
            $table->string('cell_phone_number',20);
            $table->foreignId('user_id');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users_info', function (Blueprint $table) {
            $table->foreign('user_id', 'user_info_id_fk')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('users_info', function (Blueprint $table) {
            $table->dropForeign('user_info_id_fk');
        });

        Schema::dropIfExists('users_info');
    }
}
