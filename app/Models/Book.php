<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $table='book';

    protected $primaryKey = 'book_id';

    protected $fillable = [
        'title',
        'stock',
        'image',
        'author',
    ];
}
