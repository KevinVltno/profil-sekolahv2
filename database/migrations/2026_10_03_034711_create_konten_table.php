<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('konten', function (Blueprint $t) {
            $t->id();
            $t->string('seksi', 40);
            $t->string('gambar')->default('');
            $t->string('ikon', 60)->default('');
            $t->string('judul')->default('');
            $t->text('teks')->nullable();
            $t->string('teks2')->default('');
            $t->tinyInteger('bintang')->default(0);
            $t->date('tanggal')->nullable();
            $t->string('tahun', 9)->default('');
            $t->integer('urutan')->default(0);
            $t->index(['seksi', 'urutan']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('konten');
    }
};