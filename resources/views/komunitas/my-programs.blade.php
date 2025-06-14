<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Saya - GANDENG</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/my-programs.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('landing') }}" class="logo">
                <span class="logo-text">GANDENG</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('komunitas.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ route('komunitas.my_programs') }}" class="active"><i class="fas fa-project-diagram"></i> Program Saya</a>
                <a href="{{ route('komunitas.create_campaign') }}"><i class="fas fa-plus-circle"></i> Buat Kampanye</a>
                <a href="#"><i class="fas fa-chart-line"></i> Laporan Anggaran</a> <a href="#"><i class="fas fa-comments"></i> Ulasan Donatur</a> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
            <button class="menu-toggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <main class="dashboard-content">
        <div class="container">
            <header class="page-header">
                <div>
                    <h1>Program Saya</h1>
                    <p>Daftar kampanye yang telah Anda buat</p>
                </div>
                <a href="{{ route('komunitas.create_campaign') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Kampanye Baru</a>
            </header>

            <!-- Ganti bagian programs-table -->
<div class="programs-table">
    <div class="table-header">
        <div class="col-title">Judul Program</div>
        <div class="col-status">Status</div>
        <div class="col-donation">Total Donasi</div>
        <div class="col-date">Tanggal Mulai</div>
        <div class="col-actions">Aksi</div>
    </div>

    @foreach($campaigns as $campaign)
    <div class="table-row">
        <div class="col-title">{{ $campaign->title }}</div>
        <div class="col-status">
            <span class="status-badge {{ $campaign->status == 'active' ? 'ongoing' : ($campaign->status == 'completed' ? 'completed' : 'pending') }}">
                {{ $campaign->status == 'active' ? 'Berlangsung' : ($campaign->status == 'completed' ? 'Selesai' : 'Pending') }}
            </span>
        </div>
        <div class="col-donation">Rp {{ number_format($campaign->current_amount, 0, ',', '.') }}</div>
        <div class="col-date">{{ $campaign->created_at->format('d M Y') }}</div>
        <div class="col-actions">
            <a href="{{ route('campaigns.show', $campaign->id) }}" class="btn btn-outline">Lihat Detail</a>
            @if($campaign->status == 'active')
            <a href="{{ route('komunitas.budget-report') }}" class="btn btn-outline report">Lihat Laporan</a>
            @endif
        </div>
    </div>
    @endforeach
</div>
    <script>
        // JavaScript untuk menu toggle pada navbar (dari styles.css)
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.querySelector('.menu-toggle');
            const navLinks = document.querySelector('.nav-links');

            if (menuToggle && navLinks) {
                menuToggle.addEventListener('click', () => {
                    navLinks.classList.toggle('show');
                });
            }
        });
    </script>
</body>
</html>