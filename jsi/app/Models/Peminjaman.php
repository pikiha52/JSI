<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id')->select(['id', 'name']);
    }

    public function book() {
        return $this->hasOne(Book::class, 'id', 'book_id')->select(['id', 'name']);
    }
}
