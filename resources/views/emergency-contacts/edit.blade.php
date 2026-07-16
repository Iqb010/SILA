@extends('layouts.app')

@section('title', 'Edit Kontak Darurat')

@section('page-title', 'Edit Kontak Darurat')

@section('content')
<div class="glass-card stagger-1">
    <div class="glass-header d-flex justify-content-between align-items-center">
        <h6><i class="bi bi-person-lines-fill me-2"></i> Edit Kontak Darurat</h6>
        <a href="{{ route('emergency-contacts.index') }}" class="btn-glass btn-sm">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <div class="p-4">
        <form action="{{ route('emergency-contacts.update', $emergencyContact) }}" method="POST">
            @csrf
            @method('PUT')
            @include('emergency-contacts._form')

            <div class="d-flex gap-2 mt-4">
                <button type="submit" class="btn-accent">
                    <i class="bi bi-check-circle me-1"></i> Perbarui
                </button>
                <a href="{{ route('emergency-contacts.index') }}" class="btn-glass">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
