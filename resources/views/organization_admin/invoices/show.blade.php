@extends('organization_admin.layouts.app')

@section('title', 'Invoice Details')

@section('content')
<div class="container py-4">
    <div class="bg-white text-dark p-4 rounded shadow-lg">
        <h2 class="fw-bold mb-4 border-bottom pb-2">🧾 Invoice Details</h2>

        {{-- Buyer & Invoice Info --}}
        <div class="row mb-4">
            <div class="col-md-8">
                <p><strong>Invoice Number:</strong> {{ $invoice->invoice_number }}</p>
                <p><strong>Buyer Name:</strong> {{ $invoice->user->name }}</p>
                <p><strong>Shipping Address:</strong> {{ $invoice->address }}, {{ $invoice->postal_code }}</p>
                <p><strong>Date:</strong> {{ $invoice->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="col-md-4 text-center">
                @if($invoice->payment_proof)
                <p><strong>Bukti Pembayaran:</strong></p>
                <img src="{{ $invoice->payment_proof }}" alt="Bukti Pembayaran" class="img-fluid rounded border" style="max-height: 200px;">
                @endif
            </div>
        </div>

        {{-- Product Table --}}
        <h4 class="fw-bold mt-4">🛒 Products Purchased</h4>
        <div class="table-responsive mt-3">
            <table class="table table-bordered text-center align-middle">
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
                        <td>{{ $detail->product->name }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>Rp. {{ number_format($detail->subtotal) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Footer with Status and Action --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-4">
            <div>
                <strong>Status: </strong>
                @if($invoice->status === 'pending')
                    <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                @elseif($invoice->status === 'accepted')
                    <span class="badge bg-success px-3 py-2">Accepted</span>
                @elseif($invoice->status === 'rejected')
                    <span class="badge bg-danger px-3 py-2">Rejected</span>
                @endif
            </div>

            <div class="mt-3 mt-md-0">
                @if($invoice->status === 'pending' || $invoice->status === null)
                    <form action="{{ route('organization_admin.invoices.updateStatus', $invoice->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="accepted">
                        <button type="submit" class="btn btn-success px-4 me-2">Accept</button>
                    </form>

                    <form action="{{ route('organization_admin.invoices.updateStatus', $invoice->id) }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="status" value="rejected">
                        <button type="submit" class="btn btn-danger px-4">Reject</button>
                    </form>
                @endif
            </div>
        </div>

        {{-- Total & Back --}}
        <div class="d-flex justify-content-between align-items-center mt-5">
            <h4 class="text-success fw-bold">💰 Total: Rp. {{ number_format($invoice->total_price) }}</h4>
            <a href="{{ route('organization_admin.invoices.index') }}" class="btn btn-secondary px-4">← Back to Invoices</a>
        </div>
    </div>
</div>
@endsection
