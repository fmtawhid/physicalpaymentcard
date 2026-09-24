<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'customer_country',
        'customer_district',
        'delivery_address',
        'payment_method',
        'payment_number',
        'amount',
        'payment_slip',
        'status',
        'card_info_name',
        'card_number',
        'card_holder_name',
        'card_expiry',
        'card_cvv',
        'card_info_note',
        'admin_note',
    ];

    protected function casts(): array
    {
        return ['amount' => 'decimal:2'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
