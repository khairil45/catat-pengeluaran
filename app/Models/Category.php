<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'name'
    ];

    // Relasi one-to-many dengan model Transaction
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
    }

    // Metode untuk konfigurasi pembuatan slug
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
}
