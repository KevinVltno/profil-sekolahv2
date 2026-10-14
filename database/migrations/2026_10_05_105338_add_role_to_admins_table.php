<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('admins', function (Blueprint $t) {
            $t->string('role', 20)->default('admin')->after('nama');
        });
    }

    public function down(): void
    {
        Schema::table('admins', function (Blueprint $t) {
            $t->dropColumn('role');
        });
    }
};