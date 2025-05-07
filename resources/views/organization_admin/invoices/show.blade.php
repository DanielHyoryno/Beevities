@extends('organization_admin.layouts.app')

@section('title', 'Invoice Details')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">Invoice Details</h2>

        <div class="card shadow p-4 bg-light rounded mb-4">
        <h4 class="fw-bold">Invoice Number: {{ $invoice->invoice_number }}</h4>
        <p><strong>Buyer Name:</strong> {{ $invoice->user->name }}</p>
        <p><strong>Shipping Address:</strong> {{ $invoice->address }}, {{ $invoice->postal_code }}</p>
        <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y, H:i') }}</p>

        <!-- @if($invoice->payment_proof) -->
            <div class="mt-3">
                <h5><strong>Bukti Pembayaran:</strong></h5>
                <img src="{{ $invoice->payment_proof }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 300px;">
            </div>
        <!-- @endif -->
    </div>


    <h3 class="fw-bold">Products Purchased</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoice->details as $detail)
                    <tr>
                        <td class="fw-bold">{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp. {{ number_format($detail->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <h4 class="text-end fw-bold mt-3">Total Price: Rp. {{ number_format($invoice->total_price) }}</h4>

    <div class="text-end mt-4">
        <a href="{{ route('organization_admin.invoices.index') }}" class="btn btn-secondary px-4 py-2">Back to Invoices</a>
    </div>
</div>
@endsection
