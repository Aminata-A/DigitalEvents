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
        Schema::create('evenement_users', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['accepted','declined'])->default('accepted')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('evenement_id');
            $table->foreign('evenement_id')->references('id')->on('evenements')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('evenement_users', function(Blueprint $table){
            $table->dropForeign('evenement_users_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::table('evenement_users', function(Blueprint $table){
            $table->dropForeign('evenement_users_evenement_id_foreign');
            $table->dropColumn('evenement_id');
        });
        Schema::dropIfExists('evenement_users');
    }
};
