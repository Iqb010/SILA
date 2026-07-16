<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use App\Models\Kehadiran;
use App\Models\Lansia;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::create([
            'name' => 'Admin SILA',
            'email' => 'admin@sila.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $lansiaData = [
            ['nama' => 'Siti Aminah', 'nik' => '3201234567890001', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1955-03-15', 'alamat' => 'Jl. Melati No. 10, RT 01/RW 02', 'nomor_telepon' => '081234567801'],
            ['nama' => 'Budi Santoso', 'nik' => '3201234567890002', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1950-07-22', 'alamat' => 'Jl. Mawar No. 5, RT 03/RW 01', 'nomor_telepon' => '081234567802'],
            ['nama' => 'Hj. Fatimah', 'nik' => '3201234567890003', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1958-11-08', 'alamat' => 'Jl. Anggrek No. 12, RT 02/RW 03', 'nomor_telepon' => '081234567803'],
            ['nama' => 'Ahmad Hidayat', 'nik' => '3201234567890004', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1952-01-30', 'alamat' => 'Jl. Dahlia No. 8, RT 04/RW 02', 'nomor_telepon' => '081234567804'],
            ['nama' => 'Suryati', 'nik' => '3201234567890005', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1960-05-12', 'alamat' => 'Jl. Kenanga No. 3, RT 01/RW 04', 'nomor_telepon' => '081234567805'],
            ['nama' => 'H. Muhammad Yusuf', 'nik' => '3201234567890006', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1948-09-25', 'alamat' => 'Jl. Flamboyan No. 15, RT 02/RW 01', 'nomor_telepon' => '081234567806'],
            ['nama' => 'Nurjanah', 'nik' => '3201234567890007', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1957-12-03', 'alamat' => 'Jl. Bougenville No. 7, RT 03/RW 03', 'nomor_telepon' => '081234567807'],
            ['nama' => 'Supardi', 'nik' => '3201234567890008', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1953-04-18', 'alamat' => 'Jl. Teratai No. 20, RT 05/RW 02', 'nomor_telepon' => '081234567808'],
            ['nama' => 'Imas Komariah', 'nik' => '3201234567890009', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1959-08-14', 'alamat' => 'Jl. Seroja No. 11, RT 01/RW 03', 'nomor_telepon' => null],
            ['nama' => 'Dedi Kuswandi', 'nik' => '3201234567890010', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1951-06-27', 'alamat' => 'Jl. Cempaka No. 9, RT 04/RW 01', 'nomor_telepon' => '081234567810'],
            ['nama' => 'Euis Sukaesih', 'nik' => '3201234567890011', 'jenis_kelamin' => 'Perempuan', 'tanggal_lahir' => '1956-02-10', 'alamat' => 'Jl. Kamboja No. 6, RT 02/RW 04', 'nomor_telepon' => '081234567811'],
            ['nama' => 'Ujang Supriatna', 'nik' => '3201234567890012', 'jenis_kelamin' => 'Laki-laki', 'tanggal_lahir' => '1954-10-05', 'alamat' => 'Jl. Sakura No. 14, RT 03/RW 02', 'nomor_telepon' => null],
        ];

        foreach ($lansiaData as $i => $data) {
            $l = Lansia::create($data);
            
            // Create a user account for Lansia
            User::create([
                'name' => $l->nama,
                'email' => 'lansia' . ($i + 1) . '@sila.com',
                'password' => Hash::make('password'),
                'role' => 'lansia',
                'lansia_id' => $l->id,
            ]);
        }

        $kegiatanData = [
            ['nama_kegiatan' => 'Senam Lansia', 'tanggal_kegiatan' => '2026-01-10', 'lokasi' => 'Balai Desa Sukamakmur', 'keterangan' => 'Senam pagi rutin untuk lansia'],
            ['nama_kegiatan' => 'Pemeriksaan Kesehatan', 'tanggal_kegiatan' => '2026-01-25', 'lokasi' => 'Posyandu Melati', 'keterangan' => 'Cek tekanan darah dan gula darah'],
            ['nama_kegiatan' => 'Penyuluhan Gizi', 'tanggal_kegiatan' => '2026-02-08', 'lokasi' => 'Aula Kecamatan', 'keterangan' => 'Penyuluhan tentang gizi seimbang untuk lansia'],
            ['nama_kegiatan' => 'Senam Lansia', 'tanggal_kegiatan' => '2026-02-15', 'lokasi' => 'Balai Desa Sukamakmur', 'keterangan' => 'Senam pagi rutin'],
            ['nama_kegiatan' => 'Posyandu Lansia', 'tanggal_kegiatan' => '2026-03-05', 'lokasi' => 'Posyandu Melati', 'keterangan' => 'Penimbangan dan pemeriksaan rutin'],
            ['nama_kegiatan' => 'Rekreasi Lansia', 'tanggal_kegiatan' => '2026-03-20', 'lokasi' => 'Taman Kota', 'keterangan' => 'Jalan santai dan rekreasi bersama'],
            ['nama_kegiatan' => 'Pemeriksaan Kesehatan', 'tanggal_kegiatan' => '2026-04-12', 'lokasi' => 'Puskesmas Sehat', 'keterangan' => 'Pemeriksaan kesehatan menyeluruh'],
            ['nama_kegiatan' => 'Senam Lansia', 'tanggal_kegiatan' => '2026-04-26', 'lokasi' => 'Balai Desa Sukamakmur', 'keterangan' => 'Senam rutin bulanan'],
            ['nama_kegiatan' => 'Penyuluhan Kesehatan Jiwa', 'tanggal_kegiatan' => '2026-05-10', 'lokasi' => 'Aula Kecamatan', 'keterangan' => 'Tips menjaga kesehatan mental di usia lanjut'],
            ['nama_kegiatan' => 'Posyandu Lansia', 'tanggal_kegiatan' => '2026-05-24', 'lokasi' => 'Posyandu Melati', 'keterangan' => 'Posyandu rutin bulan Mei'],
            ['nama_kegiatan' => 'Senam Lansia', 'tanggal_kegiatan' => '2026-06-07', 'lokasi' => 'Balai Desa Sukamakmur', 'keterangan' => 'Senam rutin Juni'],
            ['nama_kegiatan' => 'Pemeriksaan Kesehatan', 'tanggal_kegiatan' => '2026-06-21', 'lokasi' => 'Posyandu Melati', 'keterangan' => 'Cek kesehatan semester 1'],
        ];

        foreach ($kegiatanData as $data) {
            Kegiatan::create($data);
        }

        $lansias = Lansia::all();
        $kegiatans = Kegiatan::all();

        $hadirChance = [
            1 => 0.90, 2 => 0.85, 3 => 0.80, 4 => 0.70,
            5 => 0.75, 6 => 0.95, 7 => 0.65, 8 => 0.60,
            9 => 0.50, 10 => 0.40, 11 => 0.55, 12 => 0.35,
        ];

        foreach ($kegiatans as $kegiatan) {
            foreach ($lansias as $lansia) {
                $chance = $hadirChance[$lansia->id] ?? 0.5;
                $status = (mt_rand(1, 100) / 100) <= $chance ? 'Hadir' : 'Tidak Hadir';

                Kehadiran::create([
                    'lansia_id' => $lansia->id,
                    'kegiatan_id' => $kegiatan->id,
                    'status' => $status,
                ]);
            }
        }
    }
}
