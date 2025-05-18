@extends('user.layouts.app')

@section('title', 'Checkout')

@section('content')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beevities')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div class="container">
        <h2 class="flex">Beevities</h2>


        @if(empty($checkoutItems))
        <div class="alert alert-warning">
            Tidak ada produk yang dipilih.
            <a href="{{ route('user.cart') }}">Kembali ke Keranjang</a>
        </div>
        @else
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nama Produk</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($checkoutItems as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>Rp. {{ number_format($item['price'] * $item['quantity']) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3>Total Harga: Rp. {{ number_format($totalPrice) }}</h3>

        <form method="POST" action="{{ route('user.checkout.process') }}" enctype="multipart/form-data">
            @csrf <!-- Token CSRF -->
            <div class="mb-3">
                <label for="address" class="form-label">Alamat Pengiriman</label>
                <input type="text" name="address" class="form-control" placeholder="Masukkan alamat" required>
            </div>
            <div class="mb-3">
                <label for="postal_code" class="form-label">Kode Pos</label>
                <input type="text" name="postal_code" class="form-control" placeholder="Masukkan kode pos" required>
            </div>
            <div class="mb-3">
                <label for="payment_proof" class="form-label">Bukti Pembayaran</label>
                <input type="file" name="payment_proof" class="form-control" accept="image/*" required>
            </div>

            <input type="hidden" name="total_price" value="{{ $totalPrice }}">
            @foreach($checkoutItems as $item)
            <input type="hidden" name="selected_products[{{ $item['id'] }}]" value="{{ $item['quantity'] }}">
            @endforeach


            <button type="submit" class="btn btn-primary">Konfirmasi & Bayar</button>
        </form>

        @endif
    </div>
</body>


@endsection