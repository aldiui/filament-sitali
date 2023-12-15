<?php

namespace App\Models;

use App\Models\Tagihan;
use App\Models\TarifListrik;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggan extends Model
{
    use HasFactory;

    protected $fillable = ["nama", "no_hp", "alamat", "tarif_listrik_id"];

    public function tarif_listrik(): BelongsTo
    {
        return $this->belongsTo(TarifListrik::class);
    }

    public function tegihans(): HashMany
    {
        return $this->hasMany(Tagihan::class);
    }
}