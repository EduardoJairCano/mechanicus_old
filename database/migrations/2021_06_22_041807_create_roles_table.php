<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('roles', static function (Blueprint $table) {
            $table->id();
            $table->string('name',100)->unique();
            $table->string('display_name')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        $date = date_format(date_create('2021-01-01 12:00:00'),'Y-m-d H:i:s');

        // Default roles
        $roles = [
            [
                'name'          => 'dev',
                'display_name'  => 'Desarrollador',
                'created_at'    => $date,
                'updated_at'    => $date,
            ],
            [
                'name'          => 'staff',
                'display_name'  => 'Soporte',
                'created_at'    => $date,
                'updated_at'    => $date,
            ],
            [
                'name'          => 'owner',
                'display_name'  => 'Dueño',
                'created_at'    => $date,
                'updated_at'    => $date,
            ],
            [
                'name'          => 'admin',
                'display_name'  => 'Administrador',
                'created_at'    => $date,
                'updated_at'    => $date,
            ],
        ];

        foreach ($roles as $rol) {
            \Illuminate\Support\Facades\DB::table('roles')->insert($rol);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
}
