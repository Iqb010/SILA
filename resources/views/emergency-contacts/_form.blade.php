<div class="row g-3">
    <div class="col-md-6">
        <label for="lansia_id" class="form-label">Lansia <span class="text-danger">*</span></label>
        <select name="lansia_id" id="lansia_id" class="form-select @error('lansia_id') is-invalid @enderror" required>
            <option value="">Pilih Lansia</option>
            @foreach($lansiaList as $lansia)
                <option value="{{ $lansia->id }}" 
                    {{ old('lansia_id', $emergencyContact->lansia_id ?? request('lansia_id')) == $lansia->id ? 'selected' : '' }}>
                    {{ $lansia->nama }} - {{ $lansia->nik }}
                </option>
            @endforeach
        </select>
        @error('lansia_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="hubungan" class="form-label">Hubungan <span class="text-danger">*</span></label>
        <select name="hubungan" id="hubungan" class="form-select @error('hubungan') is-invalid @enderror" required>
            <option value="">Pilih Hubungan</option>
            <option value="anak" {{ old('hubungan', $emergencyContact->hubungan ?? '') == 'anak' ? 'selected' : '' }}>Anak</option>
            <option value="cucu" {{ old('hubungan', $emergencyContact->hubungan ?? '') == 'cucu' ? 'selected' : '' }}>Cucu</option>
            <option value="pasangan" {{ old('hubungan', $emergencyContact->hubungan ?? '') == 'pasangan' ? 'selected' : '' }}>Pasangan</option>
            <option value="saudara" {{ old('hubungan', $emergencyContact->hubungan ?? '') == 'saudara' ? 'selected' : '' }}>Saudara</option>
            <option value="lainnya" {{ old('hubungan', $emergencyContact->hubungan ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
        @error('hubungan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nama_kontak" class="form-label">Nama Kontak <span class="text-danger">*</span></label>
        <input type="text" name="nama_kontak" id="nama_kontak" 
               class="form-control @error('nama_kontak') is-invalid @enderror" 
               value="{{ old('nama_kontak', $emergencyContact->nama_kontak ?? '') }}"
               placeholder="Nama lengkap kontak darurat" required>
        @error('nama_kontak')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="nomor_telepon" class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
        <input type="text" name="nomor_telepon" id="nomor_telepon" 
               class="form-control @error('nomor_telepon') is-invalid @enderror" 
               value="{{ old('nomor_telepon', $emergencyContact->nomor_telepon ?? '') }}"
               placeholder="Contoh: 0812-3456-7890" required>
        @error('nomor_telepon')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea name="alamat" id="alamat" rows="3" 
                  class="form-control @error('alamat') is-invalid @enderror" 
                  placeholder="Alamat lengkap kontak darurat">{{ old('alamat', $emergencyContact->alamat ?? '') }}</textarea>
        @error('alamat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-12">
        <div class="form-check">
            <input type="checkbox" class="form-check-input" name="is_primary" id="is_primary" value="1"
                   {{ old('is_primary', $emergencyContact->is_primary ?? false) ? 'checked' : '' }}>
            <label class="form-check-label fw-semibold" for="is_primary" style="font-size: 0.85rem;">
                Jadikan kontak utama / prioritas
            </label>
            <div class="form-text" style="color: var(--text-muted); font-size: 0.78rem; margin-top: 0.25rem;">
                <i class="bi bi-info-circle me-1"></i>
                Hanya satu kontak yang bisa menjadi kontak utama per lansia.
            </div>
        </div>
    </div>
</div>
