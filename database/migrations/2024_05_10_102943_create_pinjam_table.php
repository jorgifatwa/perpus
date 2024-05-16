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
        Schema::create('pinjam', function (Blueprint $table) {
            $table->string('pinjam_id')->unique();
            $table->integer('book_id');
            $table->integer('anggota_id');
            $table->date('pinjam_date');
            $table->date('kembali_date')->nullable();
            $table->integer('quantity');
            $table->string('pinjam_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam');
    }
};
