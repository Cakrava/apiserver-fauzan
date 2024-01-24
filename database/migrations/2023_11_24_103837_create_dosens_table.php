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
        Schema::create('dosen2010054', function (Blueprint $table) {
            $table->char('nidn2010054', 7)->primary();
            $table->string('namalengkap2010054', 100);
            $table->enum('jenkel2010054', ['L', 'P']);
            $table->string('tmp_lahir2010054', 100);
            $table->date('tgl_lahir2010054');
            $table->string('alamat2010054', 100);
            $table->char('notelp2010054');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosen2010054');
    }
};
