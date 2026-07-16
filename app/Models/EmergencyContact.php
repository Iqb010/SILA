<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;

    protected $fillable = [
        'lansia_id',
        'nama_kontak',
        'hubungan',
        'nomor_telepon',
        'alamat',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];

    public function lansia()
    {
        return $this->belongsTo(Lansia::class);
    }

    public function getHubunganLabelAttribute()
    {
        $labels = [
            'anak' => 'Anak',
            'cucu' => 'Cucu',
            'pasangan' => 'Pasangan',
            'saudara' => 'Saudara',
            'lainnya' => 'Lainnya'
        ];

        return $labels[$this->hubungan] ?? $this->hubungan;
    }
}
