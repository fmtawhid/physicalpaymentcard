<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // Authable যদি লগইন দরকার হয়
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Merchant extends Authenticatable
{
  

    protected $table = 'merchants';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'user_id', // নতুন করে যোগ করো
        'name',
        'email',
        'phone',
        'address',
        'trade_license',
        'status',
        'verified',
        'wallet_balance',
        'bank_info',
        'nid_number',
        'nid_front',
        'nid_back',
        'store_name',
        'logo',
    ];

    /**
     * Hidden attributes for serialization
     */
    protected $hidden = [
        // যদি password থাকত
    ];

    /**
     * Casts
     */
    protected $casts = [
        'verified' => 'boolean',
        'wallet_balance' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'merchant_project', 'merchant_id', 'project_id')
            ->withTimestamps()
            ->withPivot('joined_at')
            ->withCasts(['joined_at' => 'datetime']);
    }
}
