<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name',150);
            $table->boolean('active')->default(1);
            $table->string('slug')->unique();
            $table->foreignId('customer_id');
            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
        });

        Schema::table('companies', function (Blueprint $table) {
            $table->foreign('customer_id','company_customer_id_fk')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('company_customer_id_fk');
        });

        Schema::dropIfExists('companies');
    }
}
