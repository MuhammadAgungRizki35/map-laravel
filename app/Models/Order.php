<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jumlah_pcs',
        'jumlah_plastik',
        'file_word', // ubah dari file_pdf ke file_word

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
