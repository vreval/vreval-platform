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
        Schema::create('markers', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->text('description')->nullable();
            $table->float('position_x');
            $table->float('position_y');
            $table->float('position_z');
            $table->float('rotation_x');
            $table->float('rotation_y');
            $table->float('rotation_z');
            $table->string('cad_id')->nullable();
            $table->float('survey_point_x')->nullable();
            $table->float('survey_point_y')->nullable();
            $table->float('survey_point_z')->nullable();
            $table->foreignUlid('project_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markers');
    }
};
