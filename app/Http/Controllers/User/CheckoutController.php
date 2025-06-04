<?php
namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Cart;

class CheckoutController extends Controller
{
    public function checkout(Request $request)
    {
        $selectedProducts = $request->input('selected_products', []);
        if(empty($selectedProducts)){
            return redirect()->route('user.cart')->with('error', 'Silakan pilih produk untuk checkout.');}
    
        $cartItems = Cart::whereIn('id', $selectedProducts)->where('user_id', Auth::id())
        ->with('product')
        ->get();
    
        if ($cartItems->isEmpty()){
            return redirect()->route('user.cart')->with('error', 'Keranjang kosong atau data tidak valid.');
        }
        
        $checkoutItems = $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->product->name ?? 'Produk tidak ditemukan',
                'price' => $item->product->price ?? 0,
                'quantity' => $item->quantity,
                'image' => $item->product->image ?? null,
                'image_url' => resolveImage($item->product->image ?? null), // 🔥 tambahkan ini
            ];
        });

    
        $totalPrice = $checkoutItems->sum(function ($item){
            return $item['price'] * $item['quantity'];
        });

        session([
            'checkoutItems' => $checkoutItems,
            'totalPrice'    => $totalPrice ]);
    
        return redirect()->route('user.checkout.view');
    }

    public function viewCheckout(Request $request){
        $checkoutItems = session('checkoutItems', []);
        $totalPrice = session('totalPrice', 0);

        if(empty($checkoutItems)){
            return redirect()->route('user.cart')->with('error', 'Tidak ada produk yang dipilih untuk checkout.');
        }
    
        return view('user.checkout', compact('checkoutItems', 'totalPrice'));
    }

    public function processCheckout(Request $request){
        $request->validate([
            'address' => 'required|min:10|max:100',
            'postal_code' => 'required|digits:5',
            'selected_products' => 'required|array',
            'total_price' => 'required|integer|min:1',
            'payment_proof' => 'required|image|max:2048', // ✅ Validasi gambar
        ],[
            'selected_products.required' => 'Anda harus memilih setidaknya satu produk untuk checkout.',
        ]);
    
        // 🔁 Konversi gambar ke base64
        $file = $request->file('payment_proof');
        $base64 = base64_encode(file_get_contents($file));
        $mime = $file->getMimeType();
        $base64Image = "data:$mime;base64,$base64";
    
        $selectedProducts = $request->input('selected_products');
        $totalPrice = $request->input('total_price');
    
        $invoice = Invoice::create([
            'invoice_number' => 'INV-' . time(),
            'user_id' => Auth::id(),
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'total_price' => $totalPrice,
            'payment_proof' => $base64Image, // ✅ Simpan bukti
        ]);
    
        foreach ($selectedProducts as $cartId => $quantity) {
            $cartItem = Cart::where('id', $cartId)->where('user_id', Auth::id())->with('product')->first();
    
            if(!$cartItem){
                return redirect()->route('user.cart')->with('error', 'Keranjang tidak valid.');
            }
    
            $product = $cartItem->product;
            if($product->stock < $quantity){
                return redirect()->route('user.cart')->with('error', "Stok produk {$product->name} tidak mencukupi.");
            }
    
            $product->stock -= $quantity;
            $product->save();
            InvoiceDetail::create([
                'invoice_id' => $invoice->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'subtotal' => $quantity * $product->price,
            ]);
            $cartItem->delete();
        }
    
        return redirect()->route('user.invoice', $invoice->id)->with('success', 'Checkout berhasil! Berikut faktur pembelian Anda.');
    }
    

    public function invoice($id){
        $invoice = Invoice::with('details.product')->where('user_id', Auth::id())->findOrFail($id);
        return view('user.invoice', compact('invoice'));
    }


    //ni harusny bukan punye checkout tpi malas buat file baru
    public function history(){
        $invoices = Invoice::with('details.product')->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        return view('user.history', compact('invoices'));
    }

    

}
