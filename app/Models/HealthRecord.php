<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'lansia_id',
        'tanggal_pemeriksaan',
        'berat_badan',
        'tinggi_badan',
        'tekanan_darah_sistolik',
        'tekanan_darah_diastolik',
        'gula_darah',
        'kolesterol',
        'asam_urat',
        'keluhan',
        'diagnosa',
        'tindakan',
        'obat_diberikan',
        'catatan',
        'pemeriksa_id'
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'berat_badan' => 'decimal:2',
        'tinggi_badan' => 'decimal:2',
        'tekanan_darah_sistolik' => 'decimal:2',
        'tekanan_darah_diastolik' => 'decimal:2',
        'gula_darah' => 'decimal:2',
        'kolesterol' => 'decimal:2',
        'asam_urat' => 'decimal:2'
    ];

    public function lansia()
    {
        return $this->belongsTo(Lansia::class);
    }

    public function pemeriksa()
    {
        return $this->belongsTo(User::class, 'pemeriksa_id');
    }

    public function getBmiAttribute()
    {
        if ($this->berat_badan && $this->tinggi_badan) {
            $tinggiMeter = $this->tinggi_badan / 100;
            return round($this->berat_badan / ($tinggiMeter * $tinggiMeter), 2);
        }
        return null;
    }

    public function getBmiKategoriAttribute()
    {
        $bmi = $this->bmi;
        if (!$bmi) return null;

        if ($bmi < 18.5) return 'Kurus';
        if ($bmi < 25) return 'Normal';
        if ($bmi < 30) return 'Overweight';
        return 'Obesitas';
    }

    public function getTekananDarahAttribute()
    {
        if ($this->tekanan_darah_sistolik && $this->tekanan_darah_diastolik) {
            return $this->tekanan_darah_sistolik . '/' . $this->tekanan_darah_diastolik;
        }
        return null;
    }

    public function getTekananDarahStatusAttribute()
    {
        if (!$this->tekanan_darah_sistolik || !$this->tekanan_darah_diastolik) return null;

        $sistolik = $this->tekanan_darah_sistolik;
        $diastolik = $this->tekanan_darah_diastolik;

        if ($sistolik < 120 && $diastolik < 80) return 'Normal';
        if ($sistolik < 130 && $diastolik < 80) return 'Elevated';
        if ($sistolik < 140 || $diastolik < 90) return 'Hipertensi Stage 1';
        if ($sistolik >= 140 || $diastolik >= 90) return 'Hipertensi Stage 2';
        if ($sistolik > 180 || $diastolik > 120) return 'Krisis Hipertensi';

        return 'Normal';
    }
}
