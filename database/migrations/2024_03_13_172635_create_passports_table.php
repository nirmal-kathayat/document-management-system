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
        Schema::create('passports', function (Blueprint $table) {
            $table->id();
            $table->string('passport_no')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob');
            $table->date('expiry_date');
            $table->date('issued_date');
            $table->string('type');
            $table->string('nationality');
            $table->string('district');
            $table->string('country_code');
            $table->string('gender');
            $table->string('citizen_no')->nullable();
            $table->string('image');
            $table->unsignedBigInteger('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('passports');
    }
};
