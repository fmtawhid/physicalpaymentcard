<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('country', 100)->nullable()->after('phone');
            $table->string('district', 100)->nullable()->after('country');
            $table->text('delivery_address')->nullable()->after('district');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->string('customer_country', 100)->nullable()->after('customer_phone');
            $table->string('customer_district', 100)->nullable()->after('customer_country');
            $table->text('delivery_address')->nullable()->after('customer_district');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['customer_country', 'customer_district', 'delivery_address']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['country', 'district', 'delivery_address']);
        });
    }
};