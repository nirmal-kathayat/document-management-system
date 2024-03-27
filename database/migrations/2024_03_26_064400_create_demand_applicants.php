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
        Schema::create('demand_applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('demand_id');
            $table->unsignedBigInteger('applicant_id');
            $table->string('status');
            $table->timestamps();
            $table->foreign('demand_id')->references('id')->on('demands')->onDelete('cascade');
            $table->foreign('applicant_id')->references('id')->on('applicants')->onDelete('cascade');
            $table->index(['demand_id','applicant_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demand_applicants');
    }
};
