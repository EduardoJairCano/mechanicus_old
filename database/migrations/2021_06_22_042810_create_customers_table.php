<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',150);
            $table->string('last_name',150);
            $table->string('rfc',20)->nullable();
            $table->string('email',100)->nullable();
            $table->string('cell_phone_number',20)->nullable();
            $table->string('slug')->unique();
            $table->foreignId('user_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('rfc');
            $table->index('email');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->foreign('user_id', 'customer_user_id_fk')->references('id')->on('users');
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
            $table->dropForeign('customer_user_id_fk');
        });

        Schema::dropIfExists('customers');
    }
}
