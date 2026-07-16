@extends('layouts.app')

@section('page-title', 'Tambah Lansia')

@section('content')
<div class="mb-4 section-header">
    <h4>Tambah Data Lansia</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('lansia.index') }}">Data Lansia</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="glass-card stagger-1">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('lansia.store') }}">
            @csrf
            @include('lansia._form')
            <div class="d-flex gap-2">
                <button type="submit" class="btn-accent ripple-btn"><i class="bi bi-check-lg me-1"></i> Simpan</button>
                <a href="{{ route('lansia.index') }}" class="btn-glass">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
