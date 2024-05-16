<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuKeluar extends Model
{
    use HasFactory;

    protected $table='buku_keluar';

    protected $fillable = [
        'book_id',
        'quantity',
    ];
}
