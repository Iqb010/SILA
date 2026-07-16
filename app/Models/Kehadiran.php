<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kehadiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'lansia_id',
        'kegiatan_id',
        'status',
    ];

    public function lansia(): BelongsTo
    {
        return $this->belongsTo(Lansia::class);
    }

    public function kegiatan(): BelongsTo
    {
        return $this->belongsTo(Kegiatan::class);
    }
}
