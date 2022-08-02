<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinic_services', function (Blueprint $table) {
            $table->index([
                'city_id',
                'clinic_id',
            ]);
            $table->index([
                'city_id',
                'service_id',
            ]);
            $table->index([
                'city_id',
                'doctor_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinic_services', function (Blueprint $table) {
            $table->dropIndex([
                'city_id',
                'clinic_id',
            ]);
            $table->dropIndex([
                'city_id',
                'service_id',
            ]);
            $table->dropIndex([
                'city_id',
                'doctor_id',
            ]);
        });
    }
};
