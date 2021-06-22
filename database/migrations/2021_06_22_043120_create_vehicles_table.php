<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('plate',20);
            $table->string('serial_number',40)->nullable();
            $table->string('make',50);
            $table->string('model',50);
            $table->unsignedSmallInteger('year');
            $table->string('engine',5);
            $table->unsignedTinyInteger('cylinder_count');
            $table->string('transmission',40);
            $table->string('drivetrain',40)->nullable();
            $table->string('fuel',40);
            $table->string('color',40)->nullable();
            $table->string('slug')->unique();
            $table->foreignId('customer_id');
            $table->foreignId('company_id')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('plate');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('customer_id','vehicle_customer_id_fk')->references('id')->on('customers');
        });

        Schema::table('vehicles', function (Blueprint $table) {
            $table->foreign('company_id','vehicle_company_id_fk')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->dropForeign('vehicle_customer_id_fk');
            $table->dropForeign('vehicle_company_id_fk');
        });

        Schema::dropIfExists('vehicles');
    }
}
