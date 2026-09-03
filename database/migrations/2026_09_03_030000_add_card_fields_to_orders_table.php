<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('card_number')->nullable()->after('card_info_name');
            $table->string('card_holder_name')->nullable()->after('card_number');
            $table->string('card_expiry', 10)->nullable()->after('card_holder_name');
            $table->string('card_cvv', 10)->nullable()->after('card_expiry');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['card_number', 'card_holder_name', 'card_expiry', 'card_cvv']);
        });
    }
};
