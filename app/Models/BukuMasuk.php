<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuMasuk extends Model
{
    use HasFactory;

    protected $table='buku_masuk';

    protected $fillable = [
        'book_id',
        'quantity',
    ];
}
