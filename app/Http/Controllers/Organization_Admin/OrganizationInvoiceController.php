<?php

namespace App\Http\Controllers\Organization_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invoice;

class OrganizationInvoiceController extends Controller
{
    public function index()
    {
        $organizationId = Auth::user()->organization_id;
        $invoices = Invoice::whereHas('details.product', function ($query) use ($organizationId) {
            $query->where('organization_id', $organizationId);
        })->get();

        return view('organization_admin.invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $organizationId = Auth::user()->organization_id;
        $invoice = Invoice::whereHas('details.product', function ($query) use ($organizationId) {
            $query->where('organization_id', $organizationId);
        })->findOrFail($id);

        return view('organization_admin.invoices.show', compact('invoice'));
    }

    public function updateStatus(Request $request, $id)
    {
        $organizationId = Auth::user()->organization_id;
        $invoice = Invoice::whereHas('details.product', function ($query) use ($organizationId) {
            $query->where('organization_id', $organizationId);
        })->findOrFail($id);

        $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        $invoice->status = $request->status;
        $invoice->save();

        return redirect()->route('organization_admin.invoices.show', $invoice->id)
            ->with('success', 'Status invoice diperbarui menjadi ' . $request->status);
    }

}
