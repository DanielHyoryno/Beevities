@extends('user.layouts.app')

@section('title', 'Keranjang Belanja')

@section('styles')
<style>
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    .mb-4 {
        font-size: 24px;
        font-weight: 700;
        color: rgb(5, 1, 20);
        margin-bottom: 20px;
    }

    .cart-items-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
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
        accent-color: rgb(54, 143, 246);
        margin-right: 15px;
    }

    .cart-item-image {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 15px;
    }

    .cart-item-details {
        flex: 1;
    }

    .product-name {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .organization-name {
        color: #666;
        font-size: 14px;
        margin-bottom: 10px;
    }

    .price-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .price-label, .quantity-label {
        color: #666;
        font-size: 14px;
    }

    .price-value {
        font-weight: 600;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        justify-content: flex-end; /* Align to the right */
        margin-bottom: 10px;
        gap: 10px; /* Optional: Add spacing between controls */
    }

    .input-group {
        display: flex;
        align-items: center;
    }

    .quantity-input {
        width: 40px;
        text-align: center;
        border: 1px solid #e0e0e0;
        border-left: none;
        border-right: none;
        padding: 5px;
        font-weight: 500;
        height: 30px;
    }

    .btn-quantity {
        width: 30px;
        height: 30px;
        border: 1px solid #e0e0e0;
        background-color: #f5f5f5;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn-quantity:hover {
        background-color: #e0e0e0;
    }

    .subtotal-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 10px;
        padding-top: 10px;
        border-top: 1px solid #f0f0f0;
    }

    .subtotal-label {
        font-weight: 600;
    }

    .subtotal-value {
        font-weight: 700;
        color: rgb(14, 11, 169);
    }

    .action-buttons {
        display: flex;
        justify-content: flex-end;
        margin-top: 15px;
    }

    .btn-trash {
        background: none;
        border: none;
        cursor: pointer;
        padding: 5px;
        border-radius: 25%;
        transition: background-color 0.2s;
    }

    .btn-trash:hover {
        background-color: rgba(174, 171, 170, 0.35);
    }

    .trash-icon {
        width: 20px;
        height: 20px;
    }

    .alert-warning {
        background-color: #fff8e1;
        border-color: #ffe0b2;
        color: #ff6f00;
        border-radius: 8px;
        padding: 15px;
    }

    .alert-warning a {
        color: #00aa5b;
        font-weight: 500;
        text-decoration: none;
    }

    .alert-warning a:hover {
        text-decoration: underline;
    }

    .checkout-container {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .btn-success {
        background-color: #00aa5b;
        border-color: #00aa5b;
        font-weight: 500;
        padding: 10px 24px;
        border-radius: 4px;
    }

    .btn-success:hover {
        background-color: #009552;
        border-color: #009552;
    }

    #checkout-button:disabled {
        background-color: #bdbdbd;
        border-color: #bdbdbd;
        cursor: not-allowed;
    }
</style>
@endsection


@section('content')
<div class="container mt-4">
    <h2 class="mb-4">
        <img src="https://gallery.yopriceville.com/var/albums/Free-Clipart-Pictures/Sale-Stickers-PNG/Shopping_Cart_Icon_PNG_Clipart.png?m=1629814077"
             alt="Keranjang Belanja.png"
             style="height: 30px; width: auto; vertical-align: middle; margin-right: 10px;">   
        Keranjang Belanja
    </h2>

    @if($cart->isEmpty())
        <div class="alert alert-warning">
            Keranjang Anda kosong. 
            <a href="{{ route('user.dashboard') }}">Lihat Organisasi</a>
        </div>
    @else
        <div class="cart-items-container">
            @foreach($cart as $item)
            <div class="cart-item">
                <div class="cart-item-header">
                    <input type="checkbox" class="product-checkbox" name="selected_products[]" form="checkout-form" value="{{ $item->id }}">

                    @if($item->product && $item->product->image)
                        <img src="{{ $item->product->image }}" class="cart-item-image">
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
                    <span class="price-label">Harga Satuan:</span>
                    <span class="price-value">Rp. {{ number_format($item->product->price ?? 0) }}</span>
                </div>

                <div class="quantity-controls">
                    <span class="quantity-label">Jumlah:</span>
                    <div class="input-group">
                        <button type="button" class="btn-quantity btn-decrease" data-id="{{ $item->id }}">−</button>
                        <input type="text" class="quantity-input" value="{{ $item->quantity }}" data-id="{{ $item->id }}" readonly>
                        <button type="button" class="btn-quantity btn-increase" data-id="{{ $item->id }}">+</button>
                    </div>
                </div>

                <div class="subtotal-info">
                    <span class="subtotal-label">Subtotal:</span>
                    <span class="subtotal-value" id="subtotal-{{ $item->id }}">
                        Rp. {{ number_format(($item->product->price ?? 0) * $item->quantity) }}
                    </span>
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

        {{-- Form Checkout (HANYA di bawah) --}}
        <div class="checkout-container">
            <form method="POST" action="{{ route('user.checkout') }}" id="checkout-form">
                @csrf
                <button type="submit" class="btn btn-success" id="checkout-button" disabled>Checkout</button>
            </form>
        </div>

        <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            const updateQuantityAndSubtotal = (id, change) => {
                const quantityInput = document.querySelector(`.quantity-input[data-id="${id}"]`);
                const price = parseInt(document.querySelector(`input[name="selected_products[]"][value="${id}"]`)
                                    .closest('.cart-item')
                                    .querySelector('.price-value').innerText.replace(/[^\d]/g, ''));

                let quantity = parseInt(quantityInput.value) + change;
                if (quantity < 1) quantity = 1;

                quantityInput.value = quantity;

                const subtotalElement = document.getElementById(`subtotal-${id}`);
                subtotalElement.innerText = "Rp. " + (price * quantity).toLocaleString('id-ID');
            };

            document.querySelectorAll('.btn-increase').forEach(btn => {
                btn.addEventListener('click', () => updateQuantityAndSubtotal(btn.dataset.id, 1));
            });

            document.querySelectorAll('.btn-decrease').forEach(btn => {
                btn.addEventListener('click', () => updateQuantityAndSubtotal(btn.dataset.id, -1));
            });
        });
        </script>
    @endif
</div>
@endsection
