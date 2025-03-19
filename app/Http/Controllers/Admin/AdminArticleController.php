<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Organization;

class AdminArticleController extends Controller
{
    public function index() {
        $articles = Article::with('organization')->get();
        return view('admin.articles.index', compact('articles'));
    }

    public function create() {
        $organizations = Organization::all();
        return view('admin.articles.create', compact('organizations'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Convert image to binary data
        $imageData = $request->hasFile('image') ? file_get_contents($request->file('image')->getRealPath()) : null;

        Article::create([
            'title' => $request->title,
            'organization_id' => $request->organization_id,
            'description' => $request->description,
            'image' => $imageData // Store as binary
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id) {
        $article = Article::findOrFail($id);
        $organizations = Organization::all();
        return view('admin.articles.edit', compact('article', 'organizations'));
    }

    public function update(Request $request, $id) {
        $article = Article::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        // Update image only if a new one is uploaded
        if ($request->hasFile('image')) {
            $article->image = file_get_contents($request->file('image')->getRealPath());
        }

        $article->update([
            'title' => $request->title,
            'organization_id' => $request->organization_id,
            'description' => $request->description,
            'image' => $article->image // Store updated image binary
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    public function destroy($id) {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Artikel berhasil dihapus.');
    }
}
