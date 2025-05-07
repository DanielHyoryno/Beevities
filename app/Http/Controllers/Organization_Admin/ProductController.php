<?php

namespace App\Http\Controllers\Organization_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('organization_id', Auth::user()->organization_id)->get();
        return view('organization_admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('organization_admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:80',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $productData = $request->only(['name', 'price', 'stock', 'category_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType(); // e.g., image/jpeg
            $base64 = base64_encode(file_get_contents($file));
            $productData['image'] = "data:$mime;base64,$base64";
        }

        $productData['organization_id'] = Auth::user()->organization_id;

        Product::create($productData);

        return redirect()->route('organization_admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }


    public function edit($id)
    {
        $product = Product::where('organization_id', Auth::user()->organization_id)->findOrFail($id);
        $categories = Category::all();
        return view('organization_admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $organizationId = Auth::user()->organization_id;
        $product = Product::where('organization_id', $organizationId)->findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|max:80',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $updateData = $request->only(['name', 'price', 'stock', 'category_id']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $updateData['image'] = "data:$mime;base64,$base64";
        }

        $product->update($updateData);

        return redirect()->route('organization_admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $product = Product::where('organization_id', Auth::user()->organization_id)->findOrFail($id);
        $product->delete();

        return redirect()->route('organization_admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
