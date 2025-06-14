<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Anggaran - GANDENG</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/budget-report.css') }}">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="{{ route('landing') }}" class="logo">
                <span class="logo-text">GANDENG</span>
            </a>
            <div class="nav-links">
                <a href="{{ route('komunitas.dashboard') }}"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ route('komunitas.my-programs') }}"><i class="fas fa-project-diagram"></i> Program Saya</a>
                <a href="{{ route('komunitas.create-campaign') }}"><i class="fas fa-plus-circle"></i> Buat Kampanye</a>
                <a href="{{ route('komunitas.budget-report') }}" class="active"><i class="fas fa-file-invoice-dollar"></i> Laporan Anggaran</a>
                <a href="#"><i class="fas fa-comments"></i> Ulasan Donatur</a> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
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

    <main class="report-container">
        <div class="container">
            <div class="report-header">
                <h1><i class="fas fa-file-invoice-dollar"></i> Laporan Anggaran Program</h1>
                <p>Kelola dan pantau penggunaan dana program sosial Anda</p>
            </div>

            <div class="program-selection">
                <label for="program-select"><i class="fas fa-filter"></i> Pilih Program:</label>
                <select id="program-select" class="form-select">
                    <option value="" disabled selected>-- Pilih Program --</option>
                    <option value="program1">Bantuan Buku untuk Anak Pulau</option>
                    <option value="program2">Aksi Bersih Sungai</option>
                    <option value="program3">Kesehatan Pedesaan</option>
                </select>
            </div>

            <div class="budget-summary">
                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="summary-content">
                        <h3>Dana Diterima</h3>
                        <p>Rp 10.000.000</p>
                    </div>
                </div>
                <div class="summary-card">
                    <div class="summary-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="summary-content">
                        <h3>Dana Digunakan</h3>
                        <p>Rp 8.500.000</p>
                    </div>
                </div>
                <div class="summary-card highlight">
                    <div class="summary-icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="summary-content">
                        <h3>Sisa Dana</h3>
                        <p>Rp 1.500.000</p>
                    </div>
                </div>
            </div>

            <!-- Ganti bagian report-table -->
<div class="report-table">
    <table>
        <thead>
            <tr>
                <th>Program</th>
                <th>Tanggal Penggunaan</th>
                <th>Jenis Pengeluaran</th>
                <th>Dana Digunakan</th>
                <th>Deskripsi Penggunaan</th>
                <th>Jumlah</th>
                <th>Bukti</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->campaign->title }}</td>
                <td>{{ $report->report_date->format('d M Y') }}</td>
                <td>{{ $report->expense_type }}</td> <!-- Jenis Pengeluaran -->
                <td>Rp {{ number_format($report->amount_used, 0, ',', '.') }}</td>
                <td>{{ $report->description }}</td>
                <td>{{ $report->quantity_description ?? '-' }}</td> <!-- Jumlah -->
                <td>
                    @if($report->proof_url)
                        <a href="{{ $report->proof_url }}" target="_blank" class="report-link">Lihat</a>
                    @elseif($report->document_path)
                        <a href="{{ asset('storage/'.$report->document_path) }}" class="report-link">Unduh</a>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
            <div class="important-note">
                <i class="fas fa-info-circle"></i>
                <p>Laporan ini dapat dilihat oleh donatur untuk menjaga transparansi dan akuntabilitas. </p>
            </div>
        </div>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <a href="{{ route('landing') }}" class="logo">
                        <span class="logo-text">GANDENG</span>
                    </a>
                    <p>Platform kolaborasi sosial untuk Sulawesi Tenggara</p>
                </div>
                <div class="footer-links">
                    <h3>Tautan Cepat</h3>
                    <ul>
                        <li><a href="#">Panduan Laporan</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h3>Bantuan</h3>
                    <ul>
                        <li><i class="fas fa-envelope"></i> komunitas@gandeng.org</li>
                        <li><i class="fas fa-phone"></i> (0401) 987 6543</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 GANDENG. All rights reserved.</p>
            </div>
        </div>
    </footer>
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