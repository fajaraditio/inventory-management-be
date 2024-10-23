<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('b2b_projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_code')->index();
            $table->string('project_type')->index()->nullable();
            $table->string('project_name')->index();
            $table->string('salesman_name')->index();
            $table->string('province_code')->index()->nullable();
            $table->string('province_name')->index()->nullable();
            $table->string('city_code')->index()->nullable();
            $table->string('city_name')->index()->nullable();
            $table->string('district_code')->index()->nullable();
            $table->string('district_name')->index()->nullable();
            $table->string('sub_district_code')->index()->nullable();
            $table->string('sub_district_name')->index()->nullable();
            $table->string('detail_address')->index()->nullable();
            $table->decimal('latitude', 10, 8)->index()->nullable();
            $table->decimal('longitude', 11, 8)->index()->nullable();
            $table->string('item_snapshot')->nullable();
            $table->integer('total_amount')->index()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b2b_projects');
    }
};
