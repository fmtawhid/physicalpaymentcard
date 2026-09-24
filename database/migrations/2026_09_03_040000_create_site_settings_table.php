<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('site_name')->default('payoneercard');
            $table->string('site_email')->nullable();
            $table->string('support_phone')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('bkash_number')->nullable();
            $table->string('nagad_number')->nullable();
            $table->string('rocket_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_branch')->nullable();
            $table->text('payment_instructions')->nullable();
            $table->string('order_processing_time')->nullable();
            $table->text('support_text')->nullable();
            $table->longText('privacy_policy')->nullable();
            $table->longText('terms_of_service')->nullable();
            $table->longText('refund_policy')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
