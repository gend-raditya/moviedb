<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

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
            'image_option' => 'required|in:link,upload',
            'synopsis' => 'required|string',
            'cover_image' => 'required_if:image_option,link|nullable|url',
            'cover_upload' => 'required_if:image_option,upload|nullable|image|max:2048',
        ]);

        // Buat slug
        $slug = Str::slug($request->title);

        $cover = '';

        if ($request->image_option === 'upload' && $request->hasFile('cover_upload')) {
            $imagePath = $request->file('cover_upload')->store('posters', 'public');
            $cover = asset('storage/' . $imagePath);
        } elseif ($request->image_option === 'link') {
            $cover = $request->cover_image;
        }


        Movie::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'year' => $request->year,
            'cover_image' => $cover,
            'synopsis' => $request->synopsis,
            'slug' => $slug,

        ]);

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
            'synopsis' => 'required|string',
            'image_option' => 'required|in:link,upload',
            'cover_image' => 'nullable|url|required_if:image_option,link',
            'cover_upload' => 'nullable|image|max:2048|required_if:image_option,upload',

        ]);


        if ($movie->title !== $validated['title']) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Handle image
        if ($request->image_option === 'upload' && $request->hasFile('cover_upload')) {
            $imagePath = $request->file('cover_upload')->store('posters', 'public');
            $validated['cover_image'] = asset('storage/' . $imagePath);
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

        if (Gate::allows('delete')) {
            echo "Delete movie $id";
        } else {
            abort(403, 'Tidak bisa');
        }
    }
}
