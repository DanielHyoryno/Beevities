@extends('user.layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Keranjang Belanja</h2>

    @if($cart->isEmpty())
        <div class="alert alert-warning">
            Keranjang Anda kosong. 
            <a href="{{ route('user.dashboard') }}">Lihat Organisasi</a>
        </div>
    @else

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Pilih</th>
                <th>Gambar</th>
                <th>Nama Produk</th>
                <th>Organisasi</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $item)
            <tr>
                <td>
                    {{-- CHECKBOX INI MASUK FORM LAIN DI BAWAH --}}
                    <input type="checkbox" class="product-checkbox" name="selected_products[]" value="{{ $item->id }}" form="checkout-form">
                </td>
                <td>
                    @if($item->product && $item->product->image)
                        <img src="{{ asset('storage/' . $item->product->image) }}" width="50" height="50" style="object-fit: cover;">
                    @else
                        <span>Tidak Ada Gambar</span>
                    @endif
                </td>
                <td>{{ $item->product->name ?? 'Produk tidak ditemukan' }}</td>
                <td>{{ $item->product->organization->name ?? 'Tidak diketahui' }}</td>
                <td>{{ $item->quantity }}</td>
                <td>Rp. {{ number_format($item->product->price ?? 0) }}</td>
                <td>Rp. {{ number_format(($item->product->price ?? 0) * $item->quantity) }}</td>
                <td>
                    @if($item->product)
                        <form action="{{ route('user.cart.remove', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    @else
                        <span class="text-muted">Tidak bisa dihapus</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- FORM CHECKOUT BERDIRI SENDIRI --}}
    <form method="POST" action="{{ route('user.checkout') }}" id="checkout-form">
        @csrf
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success" id="checkout-button" disabled>Checkout</button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.product-checkbox');
            const checkoutButton = document.getElementById('checkout-button');

            function updateCheckoutButton() {
                let anyChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
                checkoutButton.disabled = !anyChecked;
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateCheckoutButton);
            });

            updateCheckoutButton(); 
        });
    </script>

    @endif
</div>
@endsection
