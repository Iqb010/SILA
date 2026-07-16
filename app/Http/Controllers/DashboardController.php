<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Kehadiran;
use App\Models\Lansia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLansia = Lansia::count();
        $totalKegiatan = Kegiatan::count();
        $totalKehadiran = Kehadiran::where('status', 'Hadir')->count();

        $topLansia = [];
        if ($totalLansia > 0 && $totalKegiatan > 0) {
            $lansias = Lansia::all();
            $totalPersentase = $lansias->sum(fn ($l) => $l->persentase_keaktifan);
            $rataKeaktifan = round($totalPersentase / $totalLansia, 2);

            // Get Top 5 Lansia Teraktif
            $topLansia = $lansias->sortByDesc('persentase_keaktifan')->take(5);
        }

        $chartData = $this->getChartData();
        $pieData = $this->getPieData();

        return view('dashboard', compact(
            'totalLansia',
            'totalKegiatan',
            'totalKehadiran',
            'rataKeaktifan',
            'chartData',
            'pieData',
            'topLansia'
        ));
    }

    private function getChartData(): array
    {
        $year = now()->year;
        $months = [];
        $data = [];

        $namaBulan = [
            1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr',
            5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu',
            9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];

        for ($m = 1; $m <= 12; $m++) {
            $months[] = $namaBulan[$m];

            $kegiatanBulanIni = Kegiatan::whereYear('tanggal_kegiatan', $year)
                ->whereMonth('tanggal_kegiatan', $m)
                ->pluck('id');

            if ($kegiatanBulanIni->isEmpty()) {
                $data[] = 0;
                continue;
            }

            $totalLansia = Lansia::count();
            if ($totalLansia === 0) {
                $data[] = 0;
                continue;
            }

            $totalHadir = Kehadiran::whereIn('kegiatan_id', $kegiatanBulanIni)
                ->where('status', 'Hadir')
                ->count();

            $maxHadir = $totalLansia * $kegiatanBulanIni->count();
            $data[] = $maxHadir > 0 ? round(($totalHadir / $maxHadir) * 100, 2) : 0;
        }

        return [
            'labels' => $months,
            'data' => $data,
        ];
    }

    private function getPieData(): array
    {
        $lansias = Lansia::all();
        $kategori = [
            'Sangat Aktif' => 0,
            'Aktif' => 0,
            'Cukup Aktif' => 0,
            'Kurang Aktif' => 0,
        ];

        foreach ($lansias as $lansia) {
            $kategori[$lansia->kategori_keaktifan]++;
        }

        return [
            'labels' => array_keys($kategori),
            'data' => array_values($kategori),
        ];
    }
}
