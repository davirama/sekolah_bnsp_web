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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('nisn', 20)->unique(); // Panjang 20 karakter
            $table->string('province_id', 10)->nullable(); // Panjang 10 karakter
            $table->foreign('province_id')->references('province_id')->on('provinces');
            $table->string('city_id', 10)->nullable(); // Panjang 10 karakter
            $table->foreign('city_id')->references('city_id')->on('cities');
            $table->string('province_id_lahir', 10)->nullable(); // Panjang 10 karakter
            $table->foreign('province_id_lahir')->references('province_id')->on('provinces');
            $table->string('city_id_lahir', 10)->nullable(); // Panjang 10 karakter
            $table->foreign('city_id_lahir')->references('city_id')->on('cities');
            $table->string('kecamatan', 50)->nullable(); // Panjang 50 karakter
            $table->unsignedBigInteger('agama_id')->nullable();
            $table->foreign('agama_id')->references('agama_id')->on('agama');
            $table->string('nama_lengkap', 100)->nullable(); // Panjang 100 karakter
            $table->string('role', 10); // Panjang 10 karakter
            $table->string('email', 255)->unique(); // Panjang 255 karakter
            $table->string('password'); // Panjang default
            $table->string('phone_number', 20)->unique(); // Panjang 20 karakter
            $table->string('telp_number', 20)->default("0"); // Panjang 20 karakter
            $table->string('address_ktp', 255)->nullable(); // Panjang 255 karakter
            $table->string('address_now', 255)->nullable(); // Panjang 255 karakter
            $table->string('kewarganegaraan', 5)->nullable(); // Panjang 5 karakter
            $table->string('nama_kewarganegaraan', 100)->nullable(); // Panjang 100 karakter
            $table->string('tgl_lahir', 10)->nullable(); // Panjang 10 karakter
            $table->string('tempat_lahir', 100)->nullable(); // Panjang 100 karakter
            $table->string('negara_lahir', 100)->nullable(); // Panjang 100 karakter
            $table->string('jenis_kelamin', 10)->nullable(); // Panjang 10 karakter
            $table->string('status_menikah', 10)->nullable(); // Panjang 10 karakter
            $table->string('foto', 255)->nullable(); // Panjang 255 karakter
            $table->string('video', 255)->nullable(); // Panjang 255 karakter
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken()->nullable(); // Panjang default 100 karakter
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
