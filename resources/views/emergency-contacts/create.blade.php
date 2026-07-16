@extends('layouts.app')

@section('title', 'Tambah Kontak Darurat')

@section('page-title', 'Tambah Kontak Darurat')

@section('content')
<div class="glass-card stagger-1">
    <div class="glass-header d-flex justify-content-between align-items-center">
        <h6><i class="bi bi-person-lines-fill me-2"></i> Form Kontak Darurat Baru</h6>
        <a href="{{ route('emergency-contacts.index') }}" class="btn-glass btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="p-4">
        <form action="{{ route('emergency-contacts.store') }}" method="POST">
            @csrf
            @include('emergency-contacts._form')

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-check-circle me-1"></i> Simpan
                </button>
                <a href="{{ route('emergency-contacts.index') }}" class="btn-glass">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
