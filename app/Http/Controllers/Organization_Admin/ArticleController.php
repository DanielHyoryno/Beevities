<?php

namespace App\Http\Controllers\Organization_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $organizationId = Auth::user()->organization_id;
        $articles = Article::where('organization_id', $organizationId)->get();

        return view('organization_admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('organization_admin.articles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $imageData = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $imageData = "data:$mime;base64,$base64";
        }

        Article::create([
            'organization_id' => Auth::user()->organization_id,
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageData,
        ]);

        return redirect()->route('organization_admin.articles.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    

    public function edit($id)
    {
        $organizationId = Auth::user()->organization_id;
        $article = Article::where('organization_id', $organizationId)->findOrFail($id);

        return view('organization_admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $organizationId = Auth::user()->organization_id;
        $article = Article::where('organization_id', $organizationId)->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $updateData = $request->except(['image']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $updateData['image'] = "data:$mime;base64,$base64"; // langsung masuk ke updateData
        }

        // ✅ Update event with the new data
        $article->update($updateData);

        return redirect()->route('organization_admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $organizationId = Auth::user()->organization_id;
        $article = Article::where('organization_id', $organizationId)->findOrFail($id);
        $article->delete();

        return redirect()->route('organization_admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
