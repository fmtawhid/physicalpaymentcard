<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('users')->where('role', 'marchant')->update(['role' => 'merchant']);
    }

    public function down(): void
    {
        DB::table('users')->where('role', 'merchant')->update(['role' => 'marchant']);
    }
};