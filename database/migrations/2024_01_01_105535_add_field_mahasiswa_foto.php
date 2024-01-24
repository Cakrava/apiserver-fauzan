<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('mahasiswa_2010054', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('notelp_2010054');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('mahasiswa_2010054', function (Blueprint $table) {
            $table->dropColumn('foto');
        });
    }
};
