<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Http\Request;



class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create()
{
    return view('categories.create');
}

public function store(Request $request)
{
    $request->validate([
        'category_name' => 'required|string|max:100',
        'description' => 'nullable|string|max:255',
    ]);

    Category::create([
        'category_name' => $request->category_name,
        'description' => $request->description,
    ]);

    return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
}
}
