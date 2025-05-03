@extends('user.layouts.app')

@section('title', 'Faktur Pembelian')

@section('content')
<div class="container mt-4" id="invoice">

    <div class="text-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Toko" class="invoice-logo">
        <h2>Faktur Pembelian</h2>
        <p style="margin: 0;">Beevities Store</p>
        <p style="margin: 0;">www.beevities.com | +62 857-5440-3899</p>
        <hr style="border-top: 2px solid #333;">
    </div>

    <div class="row mb-4 invoice-details">
        <div class="col-md-6">
            <h5>Dibuat Oleh:</h5>
            <p><strong>Beevities Store</strong><br>
            Jl. Chairil Anwar No. 28A, Jakarta<br>
            support@beevities.com</p>
        </div>
        <div class="col-md-6 text-md-end">
            <h5>Ditujukan Untuk:</h5>
            <p><strong>{{ Auth::user()->name }}</strong><br>
            {{ $invoice->address }}<br>
            {{ $invoice->postal_code }}</p>
        </div>
    </div>

    <p><strong>Nomor Faktur:</strong> {{ $invoice->invoice_number }}</p>
    <p><strong>Tanggal Pembelian:</strong> {{ $invoice->created_at->format('d-m-Y H:i') }}</p>

    <table class="table table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->details as $detail)
            <tr>
                <td>{{ $detail->product->name }}</td>
                <td>{{ $detail->quantity }}</td>
                <td>Rp. {{ number_format($detail->product->price) }}</td>
                <td>Rp. {{ number_format($detail->subtotal) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        Total Harga: Rp. {{ number_format($invoice->total_price) }}
    </div>

    <div class="footer-note">
        Terima kasih telah mempercayai Beevities. <br>
        Jika Anda memiliki pertanyaan, silakan hubungi <strong>support@beevities.com</strong>
    </div>

    <div class="d-print-none mt-4 text-center">
        <button class="btn btn-primary" onclick="window.print()">Cetak Faktur</button>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">Kembali ke Dashboard</a>
    </div>
</div>
@endsection

@section('styles')
<style>
@media print {
    @page {
        size: A4 portrait;
        margin: 1.5cm;
    }

    body, html {
        font-family: 'Georgia', serif;
        font-size: 8.5pt;
        line-height: 1.4;
        background: white;
        color: #000;
    }

    .navbar, .sidebar, .d-print-none {
        display: none !important;
    }

    #invoice {
        max-width: 100%;
        padding: 0;
        margin: 0 auto;
    }

    .invoice-logo {
        width: 50px;
        margin: 0 auto 6px;
        display: block;
    }

    h2 {
        font-size: 14pt;
        margin: 0 0 4px;
        text-align: center;
    }

    .text-center {
        text-align: center;
    }

    p {
        font-size: 8pt;
        margin: 0 0 4px;
    }

    .invoice-details h5 {
        font-size: 9pt;
        margin: 0 0 4px;
    }

    .invoice-details p {
        font-size: 8pt;
        margin: 0;
    }

    hr {
        border-top: 1px solid #333;
        margin: 8px 0;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    table th, table td {
        border: 1px solid #555;
        padding: 5px;
        font-size: 8pt;
    }

    table thead {
        background-color: #f5f5f5;
    }

    .total-box {
        margin-top: 10px;
        text-align: right;
        font-size: 9pt;
        font-weight: bold;
    }

    .footer-note {
        margin-top: 16px;
        font-size: 8pt;
        text-align: center;
        border-top: 1px dashed #ccc;
        padding-top: 6px;
        color: #555;
    }
}


</style>
@endsection
