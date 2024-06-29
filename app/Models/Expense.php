<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, Sluggable, SoftDeletes;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'amount',
        'description',
        'date',
        'user_id',
        'category_id',
        'image'
    ];

    // Relasi many-to-one dengan model User
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relasi many-to-one dengan model Category
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // Nama tabel yang digunakan
    protected $table = 'expenses';

    // Method untuk mendapatkan total transaksi hari ini
    public static function getTotalExpensesToday()
    {
        $today = Carbon::today();
        return self::whereDate('date', $today)->sum('amount');
    }

    // Method untuk mendapatkan total transaksi bulan ini
    public static function getTotalExpensesThisMonth()
    {
        return self::whereYear('date', Carbon::now()->year)
            ->whereMonth('date', Carbon::now()->month)
            ->sum('amount');
    }

    // Atribut akses untuk mendapatkan tanggal transaksi yang diformat
    public function getFormattedTransactionDateAttribute()
    {
        return Carbon::parse($this->attributes['date'])->translatedFormat('d F Y');
    }

    // Metode untuk konfigurasi pembuatan slug
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'description'
            ]
        ];
    }
}
