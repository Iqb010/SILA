@extends('layouts.app')

@section('page-title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-4 col-md-6 stagger-1">
        <div class="glass-card stat-card p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(16,185,129,0.1);color:#10b981;">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Total Hadir</div>
                    <h3 class="mb-0 count-up">{{ $totalKehadiran }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-6 stagger-2">
        <div class="glass-card stat-card p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(59,130,246,0.1);color:#3b82f6;">
                    <i class="bi bi-graph-up"></i>
                </div>
                <div>
                    <div class="stat-label">Tingkat Keaktifan</div>
                    <h3 class="mb-0"><span class="count-up">{{ $persentaseKeaktifan }}</span>%</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-12 stagger-3">
        <div class="glass-card stat-card p-3 h-100">
            <div class="d-flex align-items-center gap-3">
                <div class="stat-icon" style="background:rgba(245,158,11,0.1);color:#f59e0b;">
                    <i class="bi bi-award-fill"></i>
                </div>
                <div>
                    <div class="stat-label">Kategori</div>
                    <h4 class="mb-0 fw-bold mt-1" style="color:var(--text-primary);">
                        <span class="badge-glass badge-{{ $badgeKeaktifan === 'success' ? 'success' : ($badgeKeaktifan === 'primary' ? 'primary' : ($badgeKeaktifan === 'warning' ? 'warning' : 'danger')) }}-glow">
                            {{ $kategoriKeaktifan }}
                        </span>
                    </h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-4 stagger-4">
        <div class="glass-card h-100">
            <div class="glass-header">
                <h6><i class="bi bi-pie-chart-fill me-2 text-primary"></i>Statistik Kehadiran</h6>
            </div>
            <div class="card-body p-4 d-flex justify-content-center align-items-center" style="position: relative; height: 280px;">
                <canvas id="chartKehadiran"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-8 stagger-5">
        <div class="glass-card h-100">
            <div class="glass-header">
                <h6><i class="bi bi-calendar-star-fill me-2" style="color:var(--accent2);"></i>Jadwal Kegiatan Mendatang</h6>
            </div>
            <div class="card-body p-4">
                @forelse($kegiatanMendatang as $keg)
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom border-light">
                        <div style="min-width:60px;text-align:center;background:var(--input-bg);border:1px solid var(--border);border-radius:12px;padding:8px 0;">
                            <div class="fw-bold" style="color:var(--accent2);font-size:1.1rem;line-height:1;">{{ $keg->tanggal_kegiatan->format('d') }}</div>
                            <div style="font-size:0.75rem;color:var(--text-muted);text-transform:uppercase;">{{ $keg->tanggal_kegiatan->translatedFormat('M') }}</div>
                        </div>
                        <div>
                            <h6 class="mb-1 fw-bold" style="color:var(--text-primary);">{{ $keg->nama_kegiatan }}</h6>
                            <div style="font-size:0.8rem;color:var(--text-secondary);"><i class="bi bi-geo-alt-fill me-1 text-danger opacity-75"></i>{{ $keg->lokasi }}</div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state">
                        <i class="bi bi-calendar-x"></i>
                        <p>Belum ada jadwal kegiatan mendatang</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-12 stagger-5">
        <div class="glass-card h-100">
            <div class="glass-header">
                <h6><i class="bi bi-clock-history me-2" style="color:var(--accent);"></i>Riwayat Kehadiran Anda</h6>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayatKehadiran as $kehadiran)
                                <tr>
                                    <td class="fw-semibold">{{ $kehadiran->kegiatan->nama_kegiatan }}</td>
                                    <td style="color:var(--text-secondary);font-size:0.85rem;">{{ $kehadiran->kegiatan->tanggal_kegiatan->translatedFormat('d M Y') }}</td>
                                    <td>
                                        @if($kehadiran->status === 'Hadir')
                                            <span class="badge-glass badge-success-glow"><i class="bi bi-check-circle me-1"></i>Hadir</span>
                                        @else
                                            <span class="badge-glass badge-danger-glow"><i class="bi bi-x-circle me-1"></i>Tidak Hadir</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="3"><div class="empty-state"><i class="bi bi-journal-x"></i><p>Belum ada riwayat kehadiran</p></div></td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.7/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const isDark = document.documentElement.getAttribute('data-theme') === 'dark';
    const textColor = isDark ? '#94a3b8' : '#64748b';

    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.attributeName === "data-theme") {
                location.reload(); 
            }
        });
    });
    observer.observe(document.documentElement, { attributes: true });

    const ctx = document.getElementById('chartKehadiran').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($chartKehadiran['labels']),
            datasets: [{
                data: @json($chartKehadiran['data']),
                backgroundColor: [
                    '#10b981', // Hadir
                    '#ef4444'  // Tidak Hadir
                ],
                borderWidth: 2,
                borderColor: isDark ? '#0b1120' : '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '65%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: textColor, padding: 15, usePointStyle: true }
                },
                tooltip: {
                    backgroundColor: isDark ? '#1e293b' : '#ffffff',
                    titleColor: isDark ? '#f8fafc' : '#1e293b',
                    bodyColor: isDark ? '#cbd5e1' : '#475569',
                    borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(0,0,0,0.1)',
                    borderWidth: 1,
                    padding: 10,
                    cornerRadius: 8
                }
            }
        }
    });
});
</script>
@endpush
