<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name', 'site_email', 'support_phone', 'whatsapp_number',
        'bkash_number', 'nagad_number', 'rocket_number',
        'bank_name', 'bank_account_name', 'bank_account_number', 'bank_branch',
        'payment_instructions', 'order_processing_time', 'support_text',
        'privacy_policy', 'terms_of_service', 'refund_policy',
    ];

    public static function current(): self
    {
        return static::firstOrCreate(['id' => 1], [
            'site_name' => 'DollarXcard',
            'site_email' => 'support@example.com',
            'order_processing_time' => '৫–১৫ মিনিট',
        ]);
    }
}
