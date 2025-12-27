<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice Order</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }
        h2 {
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table, th, td {
            border: 1px solid #000;
        }
        th, td {
            padding: 8px;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

    <h2>Invoice Pesanan</h2>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Tanggal:</strong> {{ $order->created_at->format('d M Y') }}</p>

    <hr>

    <p><strong>Nama:</strong> {{ $order->nama }}</p>
    <p><strong>HP:</strong> {{ $order->hp }}</p>
    <p><strong>Alamat:</strong> {{ $order->alamat }}</p>

    <table>
        <thead>
            <tr>
                <th>Produk</th>
                <th>Size</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $order->produk->nama }}</td>
                <td>{{ $order->size }}</td>
                <td class="text-right">Rp{{ number_format($order->harga_produk) }}</td>
                <td class="text-right">{{ $order->qty }}</td>
                <td class="text-right">Rp{{ number_format($order->total_harga) }}</td>
            </tr>
        </tbody>
    </table>

    <h3 style="text-align:right; margin-top:20px;">
        Total: Rp{{ number_format($order->total_harga) }}
    </h3>

</body>
</html>
