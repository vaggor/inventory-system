<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of Categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new Category.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created Category in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories',
            'description' => 'nullable|string',
        ]);

        if (Category::create($validatedData)) {
            return redirect()->route('categories.index')->with('success', 'Category created successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to create category.');
    }

    /**
     * Display the specified Category.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified Category.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified Category in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        if ($category->update($validatedData)) {
            return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
        }

        return redirect()->back()->withInput()->with('error', 'Failed to update category.');
    }

    /**
     * Remove the specified Category from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->delete()) {
            return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
        }

        return redirect()->back()->with('error', 'Failed to delete category.');
    }
}
