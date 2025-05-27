<?php
namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with('category')->latest()->paginate(12);
        return view('movies.index', compact('movies'));
    }

    public function show($slug)
    {
        // Ambil movie dengan relasi category berdasarkan slug
        $movie = Movie::with('category')->where('slug', $slug)->firstOrFail();
        return view('movies.show', compact('movie'));
    }

    public function create()
    {
        // Ambil semua category untuk dropdown
        $categories = Category::all();
        return view('movies.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'year' => 'required|integer',
            'cover_image' => 'required|url',
            'synopsis' => 'required|string',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        Movie::create($validated);

        return redirect()->route('movies.index')->with('success', 'Film berhasil ditambahkan!');
    }

    public function edit($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        return view('movies.edit', compact('movie', 'categories'));
    }

    public function update(Request $request, $slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'year' => 'required|integer',
            'cover_image' => 'required|url',
            'synopsis' => 'required|string',
        ]);

        if ($movie->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        $movie->update($validated);

        return redirect()->route('movies.show', $validated['slug'] ?? $movie->slug)
                         ->with('success', 'Film berhasil diperbarui.');
    }

    public function destroy($slug)
    {
        $movie = Movie::where('slug', $slug)->firstOrFail();
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Film berhasil dihapus.');
    }
}
