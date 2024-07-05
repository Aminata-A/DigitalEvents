<?php

use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->text('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('adress')->nullable();
            $table->string('contact_detail')->nullable();
            $table->enum('activity_area', [
                'Événements corporatifs',
                'Événements sportifs',
                'Événements culturels',
                'Mariages',
                'Anniversaires',
                'Salons et expositions',
                'Concerts et spectacles',
                'Conférences et séminaires',
                'Festivals',
                'Événements communautaires',
                'Autres',
            ])->nullable();
            $table->string('ninea')->nullable();
            $table->date('creation_date')->nullable();
            $table->enum('account_status', ['activated','disabled'])->default('activated')->nullable();
            $table->enum('validation_status', ['valid','invalid'])->default('invalid')->nullable();
            $table->string('password');
            $table->rememberToken();
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
