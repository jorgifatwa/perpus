<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    protected $table = 'anggota';

    protected $fillable = [
        'anggota_id',
        'kelas_id',
        'fullname',
        'phone',
        'email',
        'gender',
        'address'
    ];
}
