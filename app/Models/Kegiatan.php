<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kegiatan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'lokasi',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_kegiatan' => 'date',
        ];
    }

    public function kehadirans(): HasMany
    {
        return $this->hasMany(Kehadiran::class);
    }
}
