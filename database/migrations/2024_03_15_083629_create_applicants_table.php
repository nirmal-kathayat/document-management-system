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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('passport_id');
            $table->unsignedBigInteger('continent_id');
            $table->unsignedBigInteger('country_id');
            $table->string('position');
            $table->string('contact_no');
            $table->string('referred_by')->nullable();
            $table->json('family_details')->nullable();
            $table->json('personal_details')->nullable();
            $table->json('experiences')->nullable();
            $table->json('other_employment_backgrounds')->nullable();
            $table->json('educations')->nullable();
            $table->json('attachments')->nullable();
            $table->json('on_job_checklist')->nullable();
            $table->json('personal_checklist')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('passport_id')->references('id')->on('passports')->onDelete('cascade');
            $table->foreign('continent_id')->references('id')->on('continents');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->index(['passport_id','continent_id','country_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
