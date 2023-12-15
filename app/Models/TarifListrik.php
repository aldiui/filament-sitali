<?php

namespace App\Models;

use App\Models\Pelanggan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TarifListrik extends Model
{
    use HasFactory;

    protected $fillable = ["kode", "nama", "daya", "harga", "subsidi", "user_id"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pelanggans(): HashMany
    {
        return $this->hasMany(Pelanggan::class);
    }

}