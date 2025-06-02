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
    <style>
        .border-dashed-custom {
            border-style: dashed !important;
        }

        .small-text {
            font-size: 0.7rem;
        }
    </style>
</head>

<body>
    <div class="container flex ">
        <div class="d-flex pb-5 p-3 gap-2">
            <h2 class="fw-bold fs-4 text-primary me-1">Beevities</h2>
            <div class="border-start border-1 border-secondary mx-2 text-secondary"></div>
            <span class="fs-5 text-secondary">Checkout</span>
        </div>

        @if(empty($checkoutItems))
        <div class="alert alert-warning">
            Tidak ada produk yang dipilih.
            <a href="{{ route('user.cart') }}">Kembali ke Keranjang</a>
        </div>
        @else
        <div class="d-flex align justify-content-center gap-5 pb-5">
            <div class="flex w-50 justify-content-between align-items-center">
                <form id="checkout-form" class="w-100" method="POST" action="{{ route('user.checkout.process') }}" enctype="multipart/form-data">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @csrf
                    <div class=" rounded shadow p-3 px-4">
                        <h4 class="pb-3">Contact Information</h4>
                        <div class="mb-3">
                            <label for="address" class="form-label fw-semibold">Address</label>
                            <input type="text" name="address" class="form-control" placeholder="Your address" required>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="postal_code" class="form-label fw-semibold">Postal Code</label>
                            <input type="text" name="postal_code" class="form-control" placeholder="123456" required>
                            @error('postal_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>

                    <input type="hidden" name="total_price" value="{{ $totalPrice }}">
                    @foreach($checkoutItems as $item)
                    <input type="hidden" name="selected_products[{{ $item['id'] }}]" value="{{ $item['quantity'] }}">
                    @endforeach

                    <div class="d-flex flex-column flex-md-row gap-3 pt-4">
                        <div class="mb-3 p-3 rounded shadow w-100 w-md-50">
                            {{-- Menghapus flex-column dan align-items-center dari sini agar lebih sederhana, w-md-50 untuk layar medium --}}
                            <label for="QRCode" class="form-label fw-semibold d-block text-center text-md-start">Scan to Pay</label>
                            <div class="p-3 bg-light rounded text-center"> {{-- Menghapus px-5 agar QR lebih responsif, text-center untuk menengahkan QR --}}
                                <img src="{{ asset('images/qr-code.png') }}" alt="QR Code" class="img-fluid" style="max-width: 180px; height: auto;"> {{-- img-fluid dan max-width agar responsif --}}
                            </div>
                        </div>
                        <div class="mb-3 p-3 rounded shadow d-flex flex-column w-100 w-md-50">
                            <label for="fileInputTriggerLabel" class="form-label fw-semibold">Upload Picture</label> {{-- Label untuk keseluruhan blok --}}
                            <div class="p-3 bg-light rounded flex-grow-1 d-flex justify-content-center align-items-center">
                                <div class="border border-dashed-custom rounded p-3 text-center w-100">
                                    <i class="bi bi-cloud-arrow-up upload-icon fs-1" id="uploadIcon"></i>
                                    <p class="text-muted mb-3 small-text" id="fileUploadStatus">Drag and drop your image here, or</p>

                                    <input type="file" id="fileInput" name="payment_proof" class="file-input d-none" accept="image/*">
                                    {{-- Label ini berfungsi sebagai tombol --}}
                                    <label for="fileInput" id="browseButtonLabel" class="btn btn-primary">
                                        Browse Files
                                    </label>
                                    @error('payment_proof')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <div id="imagePreviewContainer" class="mt-2"></div> {{-- Kontainer untuk preview gambar --}}
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>


            <div class="d-flex flex-column w-50">
                <div class="flex-grow-1">
                    <h4 class="py-3">Order Summary</h4>
                    @if(!empty($checkoutItems) && count($checkoutItems) > 0)
                    @foreach($checkoutItems as $id => $item)
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <img src="{{ $item['image_url'] ?? 'https://via.placeholder.com/60x60.png?text=IMG' }}"
                            alt="{{ $item['name'] ?? 'Produk' }}"
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: .375rem; margin-right: 1rem;">
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-semibold">{{ $item['name'] ?? 'Nama Produk Tidak Tersedia' }}</h6>
                            <small class="text-muted">Quantity: {{ $item['quantity'] ?? 0 }}</small>
                        </div>
                        <div class="text-end ms-3">
                            <span class="fw-semibold">Rp. {{ number_format(($item['price'] ?? 0) * ($item['quantity'] ?? 0)) }}</span>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p class="text-muted text-center py-3">Your order summary is empty.</p>
                    @endif
                    <h5 class="d-flex justify-content-between mb-2 pt-3">
                        <span class="text-muted">Total</span>
                        <span class="fw-semibold">Rp. {{ number_format($totalPrice)}}</span>
                    </h5>
                </div>
                <div class="checkout-container d-flex justify-content-end pb-5">
                    <button type="submit" class="btn btn-success" form="checkout-form">Checkout</button>
                </div>

            </div>
        </div>

        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('fileInput');
            const fileUploadStatus = document.getElementById('fileUploadStatus');
            const uploadIcon = document.getElementById('uploadIcon');
            const imagePreviewContainer = document.getElementById('imagePreviewContainer');
            const browseButtonLabel = document.getElementById('browseButtonLabel');

            if (fileInput) {
                fileInput.addEventListener('change', function(event) {
                    imagePreviewContainer.innerHTML = '';

                    if (event.target.files && event.target.files.length > 0) {
                        const file = event.target.files[0];

                        fileUploadStatus.textContent = 'File: ' + file.name;
                        if (browseButtonLabel) {
                            browseButtonLabel.textContent = 'Change File';
                        }

                        if (uploadIcon) {
                            uploadIcon.classList.remove('bi-cloud-arrow-up');
                            uploadIcon.classList.add('bi-check-circle-fill');
                            uploadIcon.style.color = 'green';
                        }

                    } else {
                        fileUploadStatus.textContent = 'Drag and drop your image here, or';
                        if (browseButtonLabel) {
                            browseButtonLabel.textContent = 'Browse Files';
                        }
                        if (uploadIcon) {
                            uploadIcon.classList.remove('bi-check-circle-fill');
                            uploadIcon.classList.add('bi-cloud-arrow-up');
                            uploadIcon.style.color = '';
                        }
                    }
                });
            }
        });
    </script>
</body>


@endsection