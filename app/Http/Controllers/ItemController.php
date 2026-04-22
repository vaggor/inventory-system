<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Location;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of tItems.
     */
    public function index()
    {
        $items = Item::all();
        return view('items.index', compact('items'));
    }

    /**
     * Show the form for creating a new Item.
     */
    public function create()
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('items.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created Item in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:100|unique:items',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:0',
            'min_stock_level' => 'required|integer|min:0',
        ]);

        Item::create($validatedData);

        return redirect()->route('items.index')->with('success', 'Item created successfully.');
    }

    /**
     * Display the specified Item.
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    /**
     * Show the form for editing the specified Item.
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $locations = Location::all();
        return view('items.edit', compact('item', 'categories', 'locations'));
    }

    /**
     * Update the specified Item in storage.
     */
    public function update(Request $request, Item $item)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|max:100|unique:items,sku,' . $item->id,
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
            'quantity' => 'required|integer|min:0',
            'min_stock_level' => 'required|integer|min:0',
        ]);

        $item->update($validatedData);

        return redirect()->route('items.index')->with('success', 'Item updated successfully.');
    }

    /**
     * Remove the specified Item from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item deleted successfully.'); 
    }
}
