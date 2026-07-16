<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $query = Kegiatan::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_kegiatan', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        $kegiatans = $query->orderBy('tanggal_kegiatan', 'desc')->paginate(10)->withQueryString();

        return view('kegiatan.index', compact('kegiatans'));
    }

    public function create()
    {
        return view('kegiatan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'tanggal_kegiatan' => ['required', 'date'],
            'lokasi' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        Kegiatan::create($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('kehadirans.lansia');
        return view('kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $validated = $request->validate([
            'nama_kegiatan' => ['required', 'string', 'max:255'],
            'tanggal_kegiatan' => ['required', 'date'],
            'lokasi' => ['required', 'string', 'max:255'],
            'keterangan' => ['nullable', 'string'],
        ]);

        $kegiatan->update($validated);

        return redirect()->route('kegiatan.index')
            ->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()->route('kegiatan.index')
            ->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
