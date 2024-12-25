<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;

    protected $fillable = [
        'reader_id',
        'book_id',
        'borrow_date',
        'return_date',
    ];
    protected $casts = [
        'borrow_date' => 'date', // Hoặc 'datetime' nếu có cả giờ
        'return_date' => 'date', // Hoặc 'datetime' nếu có cả giờ
    ];
    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
