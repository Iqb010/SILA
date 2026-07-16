<?php

namespace App\Http\Controllers;

use App\Models\Lansia;
use Illuminate\Http\Request;

class LansiaController extends Controller
{
    public function index(Request $request)
    {
        $query = Lansia::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%");
            });
        }

        $lansias = $query->orderBy('nama')->paginate(10)->withQueryString();

        return view('lansia.index', compact('lansias'));
    }

    public function create()
    {
        return view('lansia.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16', 'unique:lansias,nik'],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'alamat' => ['required', 'string'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
        ]);

        Lansia::create($validated);

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil ditambahkan.');
    }

    public function show(Lansia $lansia)
    {
        $lansia->load('kehadirans.kegiatan');
        return view('lansia.show', compact('lansia'));
    }

    public function edit(Lansia $lansia)
    {
        return view('lansia.edit', compact('lansia'));
    }

    public function update(Request $request, Lansia $lansia)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'size:16', 'unique:lansias,nik,' . $lansia->id],
            'jenis_kelamin' => ['required', 'in:Laki-laki,Perempuan'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'alamat' => ['required', 'string'],
            'nomor_telepon' => ['nullable', 'string', 'max:20'],
        ]);

        $lansia->update($validated);

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil diperbarui.');
    }

    public function destroy(Lansia $lansia)
    {
        $lansia->delete();

        return redirect()->route('lansia.index')
            ->with('success', 'Data lansia berhasil dihapus.');
    }
}
