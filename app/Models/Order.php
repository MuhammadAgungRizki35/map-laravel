<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jumlah_pcs',
        'jumlah_plastik',
        'file_pdf',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}