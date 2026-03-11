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
        Schema::create('jenis_cuti', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('jenis_cuti');
            $table->integer('jatah_hari');
            $table->boolean('require_attachment')->default(false);
            $table->boolean('require_end_date')->default(false);
            $table->boolean('using_annual_leave')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_cuti');
    }
};
