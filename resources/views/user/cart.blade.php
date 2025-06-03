@extends('user.layouts.app')

@section('title', 'Keranjang Belanja')

@section('styles')
<style>
    .cart-items-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .cart-item {
        background-color: #fff;
        border-radius: 12px;
        padding: 15px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        display: flex;
        flex-direction: column;
    }

    .cart-item-header {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .product-checkbox {
        width: 18px;
        height: 18px;
        accent-color: #3693f6;
        margin-right: 10px;
        transition: box-shadow 0.2s ease, background-color 0.2s ease;
        border: 2px solid #ccc;
        border-radius: 4px;
        background-color: white;
        cursor: pointer;
        position: relative;
    }

    .product-checkbox:hover {
        box-shadow: 0 0 0 3px rgba(54, 147, 246, 0.3);
        background-color: #f0f8ff;
    }

    .cart-item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 10px;
    }

    .cart-item-details {
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .organization-name {
        font-size: 13px;
        color: #666;
    }

    .price-info,
    .subtotal-info,
    .quantity-controls {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        border: 1px solid #ccc;
        height: 30px;
    }

    .btn-quantity {
        width: 30px;
        height: 30px;
        border: 1px solid #ccc;
        background: #f2f2f2;
        cursor: pointer;
        font-weight: bold;
        border-radius: 5px;
        color: #333;
        transition: color 0.2s ease, background-color 0.2s ease;
    }

    .btn-quantity:hover {
        color: #3693f6;
        background-color: #e6e6e6;
    }

    .btn-quantity:disabled {
        background-color: #ddd;
        cursor: not-allowed;
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: auto;
    }

    .btn-trash {
        background: none;
        border: none;
        cursor: pointer;
    }

    .trash-icon {
        width: 20px;
        height: 20px;
        transition: filter 0.2s ease, opacity 0.2s ease;
        filter: grayscale(0%);
        opacity: 1;
    }

    .btn-trash:hover .trash-icon {
        filter: grayscale(100%);
        opacity: 0.6;
    }

    .checkout-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .btn-success {
        background-color: #00aa5b;
        border: none;
        padding: 10px 20px;
        color: white;
        font-weight: 600;
        border-radius: 8px;
    }

    .btn-success:disabled {
        background-color: #bbb;
        cursor: not-allowed;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        <img src="https://gallery.yopriceville.com/var/albums/Free-Clipart-Pictures/Sale-Stickers-PNG/Shopping_Cart_Icon_PNG_Clipart.png?m=1629814077"
             alt="Keranjang Belanja"
             style="height: 30px; width: auto; vertical-align: middle; margin-right: 10px;">
        Keranjang Belanja
    </h2>

    @if($cart->isEmpty())
        <div class="alert alert-warning">Keranjang Anda kosong. <a href="{{ route('user.dashboard') }}">Lihat Organisasi</a></div>
    @else
        <div class="cart-items-container">
            @foreach($cart as $item)
            <div class="cart-item">
                <div class="cart-item-header">
                    <input type="checkbox" class="product-checkbox" name="selected_products[]" form="checkout-form" value="{{ $item->id }}">

                    @if($item->product && $item->product->image)
                        <img src="{{ resolveImage($item->product->image) }}" class="cart-item-image">
                    @else
                        <div class="cart-item-image" style="background: #eee; display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 12px;">No Image</span>
                        </div>
                    @endif

                    <div class="cart-item-details">
                        <div class="product-name">{{ $item->product->name ?? 'Produk tidak ditemukan' }}</div>
                        <div class="organization-name">{{ $item->product->organization->name ?? 'Tidak diketahui' }}</div>
                    </div>
                </div>

                <div class="price-info">
                    <span>Harga:</span>
                    <span class="price-value">Rp. {{ number_format($item->product->price ?? 0) }}</span>
                </div>

                <div class="quantity-controls">
                    <button type="button" class="btn-quantity btn-decrease" data-id="{{ $item->id }}">−</button>
                    <input type="text" class="quantity-input" value="{{ $item->quantity }}" data-id="{{ $item->id }}" data-stock="{{ $item->product->stock }}" readonly>
                    <button type="button" class="btn-quantity btn-increase" data-id="{{ $item->id }}">+</button>
                </div>

                <div class="subtotal-info">
                    <span>Subtotal:</span>
                    <span id="subtotal-{{ $item->id }}">Rp. {{ number_format(($item->product->price ?? 0) * $item->quantity) }}</span>
                </div>

                <div class="action-buttons">
                    @if($item->product)
                        <form action="{{ route('user.cart.remove', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-trash">
                                <img src="https://cdn-icons-png.flaticon.com/512/2891/2891491.png" alt="Hapus" class="trash-icon">
                            </button>
                        </form>
                    @else
                        <span class="text-muted">Tidak bisa dihapus</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <div class="checkout-container">
            <form method="POST" action="{{ route('user.checkout') }}" id="checkout-form">
                @csrf
                <button type="submit" class="btn btn-success" id="checkout-button" disabled>Checkout</button>
            </form>
        </div>
    @endif
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const checkboxes = document.querySelectorAll('.product-checkbox');
    const checkoutBtn = document.getElementById('checkout-button');

    function updateCheckoutBtn() {
        checkoutBtn.disabled = !Array.from(checkboxes).some(cb => cb.checked);
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateCheckoutBtn));
    updateCheckoutBtn();

    const updateQuantityUI = (id, change) => {
        const input = document.querySelector(`.quantity-input[data-id="${id}"]`);
        const priceText = document.querySelector(`.product-checkbox[value="${id}"]`)
                            .closest('.cart-item')
                            .querySelector('.price-value').innerText;
        const price = parseInt(priceText.replace(/[^\d]/g, ''));
        const maxStock = parseInt(input.dataset.stock);

        let quantity = parseInt(input.value) + change;
        quantity = Math.max(1, Math.min(quantity, maxStock));
        input.value = quantity;

        document.getElementById(`subtotal-${id}`).innerText = "Rp. " + (price * quantity).toLocaleString('id-ID');

        const btnInc = document.querySelector(`.btn-increase[data-id="${id}"]`);
        const btnDec = document.querySelector(`.btn-decrease[data-id="${id}"]`);
        btnInc.disabled = quantity >= maxStock;
        btnDec.disabled = quantity <= 1;

        fetch(`/user/cart/update/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ quantity })
        });

    };

    document.querySelectorAll('.btn-increase').forEach(btn => {
        btn.addEventListener('click', () => updateQuantityUI(btn.dataset.id, 1));
    });

    document.querySelectorAll('.btn-decrease').forEach(btn => {
        btn.addEventListener('click', () => updateQuantityUI(btn.dataset.id, -1));
    });

    document.querySelectorAll('.quantity-input').forEach(input => {
        updateQuantityUI(input.dataset.id, 0);
    });
});
</script>
@endsection
