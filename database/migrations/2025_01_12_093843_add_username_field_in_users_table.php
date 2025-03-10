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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->after('name');
            $table->string('phone')->after('username');
            $table->string('address')->after('email')->nullable();
            $table->enum('status', ['owner','user','admin'])->default('user');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('address');
            $table->dropColumn('status');
        });
    }
};
