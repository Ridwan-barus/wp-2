@extends('frontend.layout')

@section('content')

@php
    $allSizes = ['S', 'M', 'L', 'XL', 'Custom'];
    $availableSizes = $sizes->pluck('size')->map(fn($s) => strtoupper($s))->toArray();
@endphp

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<h3 class="fw-bold mb-4 container-fluid px-5">Pembelian Produk</h3>

<div class="row g-4 container-fluid px-5">

    <!-- {{-- PRODUK --}} -->
    <div class="row justify-content-center">
        <div class="row border rounded p-3 shadow-sm">
            <div class="col-md-6">
                <img src="{{ asset('uploads/' . $produk->gambar) }}" 
                     class="img-fluid rounded mb-3"
                     style="width:100%; height:auto; object-fit:cover;">
            </div>
            <div class="col-md-6">
                <h4 class="fw-bold">{{ $produk->nama }}</h4>
    
                <p class="text-muted small text-uppercase">
                    {{ $produk->kategori }}
                </p>
    
                <h4 class="text-danger fw-bold">
                    Rp{{ number_format($produk->harga, 0, ',', '.') }}
                </h4>
    
                <!-- {{-- qty --}} -->
                <div class="mt-4">
                    <label class="fw-semibold mb-2">Jumlah</label>
                    
                    <div class="d-flex align-items-center" style="width:150px;">

                        <!-- tombol min -->
                        <button type="button" id="btnMinus" 
                            class="btn btn-outline-dark d-flex align-items-center justify-content-center" 
                            style="width:40px; height:40px; border:none;">
                            <span class="fs-4">-</span>
                        </button>

                        <!-- angka qty -->
                        <input type="text" 
                            id="qtyInput" 
                            name="qty"
                            value="1"
                            class="form-control text-center mx-1" 
                            style="width:60px;"
                            readonly>
                        
                        <!-- tombol plus -->
                        <button type="button" id="btnPlus" 
                            class="btn btn-outline-dark d-flex align-items-center justify-content-center" 
                            style="width:40px; height:40px; border:none">
                            <span class="fs-4">+</span>
                        </button>
                    </div>
                </div>

                <!-- {{-- size --}} -->
                 <div class="mt-4">
                    <label class="fw-semibold mb-2">Ukuran</label>

                    <div class="d-flex gap-2 flex-wrap">
                        @foreach($allSizes as $ukuran)
                            @php
                                $isAvailable = in_array(strtoupper($ukuran), $availableSizes);
                            @endphp

                            <button
                                type="button"
                                class="btn btn-outline-dark size-btn {{ $isAvailable ? '' : 'disabled' }}"
                                data-value="{{ $ukuran }}" {{ $isAvailable ? '' : 'disabled' }}>
                                {{ $ukuran }}
                            </button>
                        @endforeach
                    </div>
                 </div>
    
                <!-- {{-- total --}} -->
                <div class="mt-3">
                    <h5 class="fw-bold">
                        Total: 
                        <span id="totalHarga" class="text-danger">
                            Rp{{ number_format($produk->harga, 0, ',', '.') }}
                        </span>
                    </h5>
                </div>
            </div>
        </div>
    </div>

    <!-- {{-- FORM DATA PEMBELI --}} -->
    <div class="border rounded p-4 shadow-sm">

        <h5 class="fw-bold mb-3">Data Pembeli</h5>

        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf

            <input type="hidden" name="size" id="sizeInput" required>

            <input type="hidden" name="produk_id" value="{{ $produk->id }}">
            <input type="hidden" name="harga_produk" value="{{ $produk->harga }}">

            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" value="{{ Auth::user()->nama }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat Pengiriman</label>
                <textarea name="alamat" class="form-control" rows="4" required></textarea>
            </div>

            <!-- {{-- QTY dikirim dari input qtyInput --}} -->
            <input type="hidden" id="qtyHidden" name="qty" value="1">

            <button class="btn btn-primary btn-lg w-100">
                Lanjut Pembayaran
            </button>
        </form>

    </div>

</div>

<script>
    const sizeStock = {
        @foreach ($sizes as $s)
            "{{ strtoupper($s->size) }}": {{ $s->stok }},
        @endforeach
    };
</script>


<script>
    const sizeButtons = document.querySelectorAll('.size-btn:not(.disabled)');
    const sizeInput = document.getElementById('sizeInput');
    let qtyInput = document.getElementById('qtyInput');
    let qtyHidden = document.getElementById('qtyHidden');

    let currentStock = 0;

    sizeButtons.forEach(btn => {
        btn.addEventListener('click', function() {

            // hapus aktif
            sizeButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            //simpan ukuran
            const size = this.dataset.value;
            sizeInput.value = size;

            //ambil stok sesuai ukuran
            currentStock = sizeStock[size] ?? 0;

            //reset qty ke 1
            qtyInput.value = 1;
            qtyHidden.value = 1;
        });
    });
</script>


<!-- {{-- SCRIPT UPDATE TOTAL --}} -->
<script>
    let harga = {{ $produk->harga }};
    // let stok = {{ $produk->stok }};
    let totalHarga = document.getElementById('totalHarga');

    document.getElementById('btnMinus').addEventListener("click", function () {
        let qty = parseInt(qtyInput.value);
        if (qty > 1) qty--;
        qtyInput.value = qty;
        qtyHidden.value = qty;
        updateTotal(qty);
    });

    document.getElementById('btnPlus').addEventListener("click", function () {
        if (!sizeInput.value) return alert('Pilih ukuran dulu');

        let qty = parseInt(qtyInput.value);
        if (qty < currentStock) qty++;

        qtyInput.value = qty;
        qtyHidden.value = qty;
        updateTotal(qty);
    });

    function updateTotal(qty) {
        totalHarga.textContent = "Rp" + (harga * qty).toLocaleString('id-ID');
    }
</script>

@endsection
