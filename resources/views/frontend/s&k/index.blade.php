@extends('frontend.layout')

@section('title', 'Syarat & Ketentuan')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Syarat & Ketentuan</h2>

    <div class="card shadow-sm border-0 p-4">
        <p>
            Selamat datang di <strong>MyBatik</strong>. Dengan mengakses dan menggunakan website ini,
            Anda dianggap telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.
        </p>

        <hr>

        <h5 class="fw-bold">1. Ketentuan Umum</h5>
        <p>
            Website MyBatik menyediakan layanan penjualan produk batik secara online.
            Seluruh transaksi yang dilakukan melalui website ini tunduk pada syarat dan ketentuan yang berlaku.
        </p>

        <h5 class="fw-bold mt-3">2. Akun Pengguna</h5>
        <ul>
            <li>Pengguna wajib memberikan data yang benar dan akurat saat melakukan pendaftaran.</li>
            <li>Keamanan akun dan kata sandi menjadi tanggung jawab pengguna.</li>
            <li>MyBatik berhak menonaktifkan akun jika ditemukan penyalahgunaan.</li>
        </ul>

        <h5 class="fw-bold mt-3">3. Produk</h5>
        <ul>
            <li>Produk yang ditampilkan adalah batik asli sesuai deskripsi yang tersedia.</li>
            <li>Perbedaan warna dapat terjadi akibat pencahayaan atau tampilan layar.</li>
            <li>Ketersediaan stok dapat berubah sewaktu-waktu.</li>
        </ul>

        <h5 class="fw-bold mt-3">4. Harga dan Pembayaran</h5>
        <ul>
            <li>Harga yang tertera adalah harga resmi dan dapat berubah tanpa pemberitahuan sebelumnya.</li>
            <li>Pembayaran dilakukan melalui metode yang tersedia di website.</li>
            <li>Pesanan akan diproses setelah pembayaran dikonfirmasi.</li>
        </ul>

        <h5 class="fw-bold mt-3">5. Pengiriman</h5>
        <p>
            MyBatik bekerja sama dengan jasa pengiriman pihak ketiga.
            Lama pengiriman menyesuaikan dengan lokasi dan kebijakan jasa pengiriman.
        </p>

        <h5 class="fw-bold mt-3">6. Penukaran dan Pengembalian</h5>
        <ul>
            <li>Penukaran atau pengembalian hanya dapat dilakukan jika produk cacat atau tidak sesuai pesanan.</li>
            <li>Pengajuan maksimal 2 x 24 jam setelah produk diterima.</li>
            <li>Produk harus dalam kondisi asli dan belum digunakan.</li>
        </ul>

        <h5 class="fw-bold mt-3">7. Hak dan Kewajiban</h5>
        <p>
            MyBatik berhak mengubah, memperbarui, atau menghentikan layanan sewaktu-waktu
            tanpa pemberitahuan terlebih dahulu.
        </p>

        <h5 class="fw-bold mt-3">8. Hukum yang Berlaku</h5>
        <p>
            Seluruh syarat dan ketentuan ini diatur dan tunduk pada hukum yang berlaku di Republik Indonesia.
        </p>

        <h5 class="fw-bold mt-3">9. Kontak</h5>
        <p>
            Jika Anda memiliki pertanyaan terkait syarat dan ketentuan ini,
            silakan hubungi kami melalui halaman kontak yang tersedia.
        </p>

        <p class="mt-4 text-muted">
            Terakhir diperbarui: {{ date('d F Y') }}
        </p>
    </div>
</div>
@endsection