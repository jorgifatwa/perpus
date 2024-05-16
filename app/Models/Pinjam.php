<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam extends Model
{
    use HasFactory;

    protected $table = 'pinjam';

    protected $fillable = [
        'pinjam_id',
        'book_id',
        'anggota_id',
        'pinjam_date',
        'quantity',
        'pinjam_status',
        
    ];
}
