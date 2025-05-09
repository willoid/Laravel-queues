<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use hasFactory;
    protected $fillable = [
        'name',
        'biography',
        'birth_date',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
