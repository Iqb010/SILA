@extends('layouts.app')

@section('page-title', 'Edit Kegiatan')

@section('content')
<div class="mb-4 section-header">
    <h4>Edit Kegiatan</h4>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('kegiatan.index') }}">Data Kegiatan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="glass-card stagger-1">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('kegiatan.update', $kegiatan) }}">
            @csrf @method('PUT')
            @include('kegiatan._form')
            <div class="d-flex gap-2">
                <button type="submit" class="btn-accent ripple-btn"><i class="bi bi-check-lg me-1"></i> Perbarui</button>
                <a href="{{ route('kegiatan.index') }}" class="btn-glass">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
