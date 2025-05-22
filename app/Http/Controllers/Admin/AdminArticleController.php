<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Organization;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('organization')->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $organizations = Organization::all();
        return view('admin.articles.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $data['image'] = "data:$mime;base64,$base64";
        }

        Article::create($data);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $organizations = Organization::all();
        return view('admin.articles.edit', compact('article', 'organizations'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $updateData = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $updateData['image'] = "data:$mime;base64,$base64";
        }

        $article->update($updateData);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
