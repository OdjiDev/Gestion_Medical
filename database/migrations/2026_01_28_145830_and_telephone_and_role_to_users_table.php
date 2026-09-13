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
        $table->string('telephone')->nullable()->after('email'); // colonne téléphone
        // $table->string('role')->default('user')->after('telephone'); // colonne rôle
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
        $table->dropColumn(['telephone', 'role']); // supprime les colonnes si rollback
    });
    }
};
