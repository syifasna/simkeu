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
        Schema::table('siswas', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['L', 'P'])
                ->nullable()
                ->after('nama_siswa');

            $table->date('tanggal_lahir')
                ->nullable()
                ->after('jenis_kelamin');

            $table->string('nama_wali', 100)
                ->nullable()
                ->after('no_hp');

            $table->string('no_hp_wali', 20)
                ->nullable()
                ->after('nama_wali');

            $table->boolean('status_aktif')
                ->default(true)
                ->after('no_hp_wali');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('siswas', function (Blueprint $table) {
            $table->dropColumn([
                'jenis_kelamin',
                'tanggal_lahir',
                'nama_wali',
                'no_hp_wali',
                'status_aktif',
            ]);
        });
    }
};
