<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'description',
        'url',
        'start_date',
        'end_date',
        'total_funding',
        'investor',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'total_funding' => 'decimal:2',
        ];
    }

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class, 'merchant_project', 'project_id', 'merchant_id')
            ->withTimestamps()
            ->withPivot('joined_at')
            ->withCasts(['joined_at' => 'datetime']);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
