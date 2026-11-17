<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('balance', 12, 2)->default(0);
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->decimal('balance_credit', 12, 2)->default(0);
            $table->timestamp('balance_credited_at')->nullable();
        });

        DB::table('orders')
            ->where('status', 'approved')
            ->update(['balance_credited_at' => now()]);
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['balance_credit', 'balance_credited_at']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('balance');
        });
    }
};
