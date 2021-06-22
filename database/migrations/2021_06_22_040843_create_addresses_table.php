<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('street_address',150);
            $table->string('outdoor_number',10);
            $table->string('interior_number',10)->nullable();
            $table->string('colony',150);
            $table->unsignedMediumInteger('postal_code')->nullable();
            $table->string('city',100);
            $table->string('state',100);
            $table->string('country',100);
            $table->string('phone_number',20)->nullable();
            $table->string('fax_number',20)->nullable();
            $table->unsignedBigInteger('addressable_id');
            $table->string('addressable_type');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
}
