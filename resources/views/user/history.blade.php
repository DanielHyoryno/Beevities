@extends('user.layouts.app')

@section('title', 'Riwayat Pembelian')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary fw-bold">🧾 Riwayat Pembelian Anda</h2>

    @if($invoices->isEmpty())
        <div class="alert alert-warning text-center shadow-sm rounded">
            <i class="bi bi-exclamation-triangle-fill"></i> Anda belum melakukan pembelian. 
            <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-outline-primary mt-2">Kembali ke Beranda</a>
        </div>
    @else
        @foreach($invoices as $invoice)
        <div class="card shadow-lg mb-5 border-0 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                <div><strong>🧾 Faktur:</strong> {{ $invoice->invoice_number }}</div>
                <div><strong>🗓️ Tanggal:</strong> {{ $invoice->created_at->format('d-m-Y H:i') }}</div>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <p><i class="bi bi-geo-alt-fill text-danger"></i> <strong>Alamat:</strong> {{ $invoice->address }}</p>
                    <p><i class="bi bi-mailbox2"></i> <strong>Kode Pos:</strong> {{ $invoice->postal_code }}</p>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>📦 Produk</th>
                                <th>🔢 Jumlah</th>
                                <th>💵 Harga Satuan</th>
                                <th>🧮 Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoice->details as $detail)
                            <tr>
                                <td>{{ $detail->product->name ?? 'Produk tidak ditemukan' }}</td>
                                <td class="text-center">{{ $detail->quantity }}</td>
                                <td>Rp. {{ number_format($detail->product->price ?? 0) }}</td>
                                <td>Rp. {{ number_format($detail->subtotal) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h5 class="text-end text-success mt-3">💰 Total: Rp. {{ number_format($invoice->total_price) }}</h5>
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
